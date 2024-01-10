<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];
    $editCategory = $_POST['editCategory'];
    $editTitle = $_POST['editTitle'];
    $editDate = $_POST['editDate'];
    $editDescription = $_POST['editDescription'];

    $parsedDate = strtotime($editDate);
    $formattedDate = date("Y-m-d", $parsedDate);

    if ($_FILES['editImage']['size'] > 0) {
        $targetDirectory = "uploads/";  
        $targetFile = $targetDirectory . basename($_FILES["editImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["editImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Error: File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($targetFile)) {
            echo "Error: File already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["editImage"]["size"] > 500000) {
            echo "Error: File is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Error: Image was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["editImage"]["tmp_name"], $targetFile)) {
                echo "Image uploaded successfully.";
                $stmt = $conn->prepare("UPDATE blog_posts SET category = ?, title = ?, date = ?, description = ?, image = ? WHERE id = ?");
                $stmt->bind_param("sssssi", $editCategory, $editTitle, $formattedDate, $editDescription, $targetFile, $postId);
            } else {
                echo "Error uploading image.";
            }
        }
    } else {
        $stmt = $conn->prepare("UPDATE blog_posts SET category = ?, title = ?, date = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $editCategory, $editTitle, $formattedDate, $editDescription, $postId);
    }

    if ($stmt->execute()) {
        echo "Post updated successfully";
    } else {
        echo "Error updating post: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>
