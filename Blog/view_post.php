<?php
// view_post.php

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

    $result = $conn->query("SELECT * FROM blog_posts WHERE id = $postId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display post details here
        echo "<h2>" . $row['title'] . "</h2>";
        
        // Check if 'content' key exists before accessing it
        if (isset($row['content'])) {
            echo "<p>" . $row['content'] . "</p>";
        } else {
            echo "Content not available.";
        }
        // Add more details as needed

    } else {
        echo "Post not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

