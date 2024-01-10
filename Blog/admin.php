<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waverlite Admin Panel</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-i/BbAPsW6fB4QaL3t3ewrD2+7hCt2JOpZPB/2ki2hZuBfvnE/gM1t4DOOh9X9ugffLtFtlzlknmDIrG6cRq06w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-panel {
            margin-top: 80px; 
        }

        .admin-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .login {
            margin-left: 500px;
        }

        #postForm {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        #postForm label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        #postForm input,
        #postForm textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #postForm button {
            padding: 10px 15px;
            background-color: var(--second-color);
            color: var(--bg-color);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #postForm button:hover {
            background-color: hsl(199, 98%, 56%);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .admin-table th {
            background-color: var(--second-color);
            color: var(--bg-color);
        }
    </style>
</head>
<body>
    <header>
        <div class="nav container">
            <a href="#" class="logo">
                <img src="logo.png" alt="Waverlite Admin">
            </a>
            <?php
            session_start();
            
            if (isset($_SESSION['login_message'])) {
                echo '<span class="login">Welcome, ' . $_SESSION['username'] . '</span>';
            } else {
                echo '<a href="#" class="login">Sign Up</a>';
            }
            ?>
                   <a href="logout.php" class="sign-out">
    <i class="fa fa-sign-out" style="font-size:36px;color: rgba(77, 228, 255);"></i>
</a>
        </div>

    </header>

    <section class="admin-panel container">
    <h2 class="admin-title">Blog Post Management</h2>
    
    <form id="postForm" action="process_post.php" method="post" enctype="multipart/form-data">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>

        <label for="postTitle">Post Title:</label>
        <input type="text" id="postTitle" name="postTitle" required>

        <label for="postDate">Post Date:</label>
        <input type="date" id="postDate" name="postDate" required>
        
        <label for="postDescription">Post Description:</label>
        <textarea id="postDescription" name="postDescription" rows="4" required></textarea>

        <label for="postImage">Post Image:</label>
        <input type="file" id="postImage" name="postImage" accept="image/*" required>

        <button type="submit">Add Post</button>
    </form>
    <h2 class="admin-title">Existing Posts</h2>

<table class="admin-table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Date</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "blog";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM blog_posts");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' alt='Post Image' style='max-width: 100px;'></td>";
            
                echo "<td>";
                echo "<a href='edit_post.php?id=" . $row['id'] . "'>Edit</a>";
                echo "</td>";

                echo "<td>";
                echo "<a href='delete_post.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>";
                echo "</td>";

                echo "</tr>";
            }
        }

        $conn->close();
        ?>
    </tbody>
</table>

</section>

    <footer>
        <div class="footer-container">
            <div class="sec aboutus">
                <h2>About Us</h2>
                <p>Waverlite is a digital global payment wallet for immigrants, international students, freelancers, and expanding businesses to send and receive instant payments in over 40 countries and 16 currencies.</p>
                <ul class="sci">
                    <li><a href="#"><i class="bx bxl-facebook"></i></a></li>
                    <li><a href="#"><i class="bx bxl-instagram"></i></a></li>
                    <li><a href="#"><i class="bx bxl-twitter"></i></a></li>
                    <li><a href="#"><i class="bx bxl-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="sec quicklinks">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </div>
            <div class="sec contactBx">
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                        <span><i class='bx bxs-map'></i></span>
                        <span>405 The West Mall, Etobicoke <br> Ontario M9C 5J1 <br> Canada</span>
                    </li>
                    <li>
                        <span><i class='bx bx-envelope' ></i></span>
                        <p><a href="mailto:codemyhobby9@gmail.com">support@waverlite.email</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/index.js"></script>
    <script src="js/main.js"></script>
</body>
</html>