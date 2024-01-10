<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Post not found";
        exit;
    }

    ?>
<form action="update_post.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="postId" value="<?php echo $row['id']; ?>">
    <label for="editCategory">Category:</label>
    <input type="text" id="editCategory" name="editCategory" value="<?php echo $row['category']; ?>"><br>
    <label for="editTitle">Title:</label>
    <input type="text" id="editTitle" name="editTitle" value="<?php echo $row['title']; ?>"><br>
    <label for="editDate">Date:</label>
    <input type="date" id="editDate" name="editDate" value="<?php echo $row['date']; ?>"><br>
    <label for="editDescription">Description:</label>
    <textarea id="editDescription" name="editDescription"><?php echo $row['description']; ?></textarea><br>
    <label for="editImage">Change Image:</label>
    <input type="file" id="editImage" name="editImage" accept="image/*">
    <button type="submit">Update Post</button>
</form>
    <?php

    $stmt->close();
} else {
    echo "Invalid request";
}

$conn->close();
?>