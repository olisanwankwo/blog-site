<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $stmt->close();
        $conn->close();
        session_start();
        $_SESSION['login_message'] = "Login successful! Welcome, " . $row['username'] . "!";
        $_SESSION['username'] = $row['username'];

        header("refresh:5;url=./admin.php");

        echo '<div class="alert alert-success" role="alert">
                Login successful. Redirecting to admin page in 5 seconds.
              </div>';
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Incorrect password
              </div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">
            User not found
          </div>';
}

$stmt->close();
$conn->close();
?>
