<?php
    // Your PHP code remains unchanged
    $category = $_POST['category'];
    $postTitle = $_POST['postTitle'];
    $postDate = $_POST['postDate'];
    $postDescription = $_POST['postDescription'];

    $parsedDate = strtotime($postDate);
    $formattedDate = date("Y-m-d", $parsedDate);

    $targetDir = "uploads/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES['postImage']['name']);
    move_uploaded_file($_FILES['postImage']['tmp_name'], $targetFile);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO blog_posts (category, title, date, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $category, $postTitle, $formattedDate, $postDescription, $targetFile);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    ?>