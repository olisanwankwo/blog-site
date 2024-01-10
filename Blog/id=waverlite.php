<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waverlite</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="nav container">
            <a href="#" class="logo">
                <img src="logo.png" alt="Code myhobby">
              </a>   
        </div>
    </header>

    <section class="home" id="home">
        <div class="home-text container">
            <h2 class="home-title">Waverlite Blogger</h2>
            <span class="home-subtitle">Your source of great content</span>
        </div>
    </section>

    <section class="about container" id="about">
        <div class="contentBx">
            <h2 class="titleText">Catch up with the trending topics</h2>
            <p class="title-text" style="
    color: #111;
    font-size: 1em;
    text-align: revert;
    line-height: 1.5;
    margin: 10px 0;
">
                In today's fast-paced society, having an efficient process for sending and receiving money that keeps up with ever-changing trends is crucial. Whether you're supporting loved ones in another country, a student navigating uncharted waters, a freelancer relying on timely payments, or a business expanding its horizons, speed is of utmost importance. Enter Waverlite, the game-changer in transactions. This blog aims to enlighten you about why Waverlite is the most intelligent solution for immigrants, students, freelancers, and businesses looking to stay ahead in the constantly evolving world of global finance.
                <br> Come along with us on this journey to explore how Waverlite enables you to keep up with the topics shaping your life.
            </p>
            <div class="content" style="
    display: none;
">
                <p>This blog is your guide to understanding why Waverlite stands out as the most intelligent choice for immigrants, students, freelancers, and businesses alike. Join us on a journey to explore how Waverlite empowers you to stay ahead in the fast-paced and ever-changing realm of global finance. Discover the features, benefits, and real-world applications that make Waverlite the game-changer in today's financial landscape. Keep pace with the topics that shape your life, and embrace the future of financial transactions with Waverlite.</p>
</div>
<a class="btn2" onclick="toggleContent()" style="
    cursor: pointer;
">Read more</a>
        </div>
        <div class="imgBx">
            <img src="images/about.png" alt="" class="fitBg">
        </div>
    </section>

    <div class="post-filter container">
   
        <span class="filter-item active-filter" data-filter="all">All</span>
        <span class="filter-item" data-filter="transfer">Transfer</span>
        <span class="filter-item" data-filter="gift">Gift Card</span>
        <span class="filter-item" data-filter="app">App</span>
    </div>
    
    <div class="post container">
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
        echo "<div class='post-box " . $row['category'] . "'>";
        echo "<img src='" . $row['image'] . "' alt='' class='post-img'>";
        echo "<h2 class='category'>" . $row['category'] . "</h2>";
        echo "<a href='#' class='post-title'>" . $row['title'] . "</a>";

        $formattedDate = date("j M Y", strtotime($row['date']));
        echo "<span class='post-date'>" . $formattedDate . "</span>";

        echo "<p class='post-description'>" . $row['description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "No records found.";
}

$conn->close();
?>
    </div>

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
    <script>
        function toggleContent() {
            var contentDiv = document.querySelector('.content');
            contentDiv.style.display = (contentDiv.style.display === 'none' || contentDiv.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>