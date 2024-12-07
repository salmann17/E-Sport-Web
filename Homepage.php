<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("location: backendMember\member\dblogin.php?url_asal=".$url);
    exit();
}

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: DashboardAdmin.php");
    exit();
}

$idmember = $_SESSION['userid'];

require_once("backendAdmin/models/member.php");
$member = new Member();
$result = $member->getMemberbyId($idmember);
while ($row = $result->fetch_assoc()) {
    $username = $row['fname'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sport Landing Page</title>
    <link rel="stylesheet" href="backendMember/css/dbmember.css">
    <link rel="stylesheet" href="backendMember/css/navbar.css">
    <link rel="stylesheet" href="backendMember/css/img.css">
    <link rel="icon" href="backendMember/icon/logo.png" type="image/png">
    <script src="backendAdmin/jquery-3.5.1.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="backendMember/icon/logo.png" alt="esport-logo">
        </div>
        <ul class="nav-links">
            <li><a href="DashboardMember.php">Home</a></li>
            <li><a href="backendMember/member/dblogin.php">Join Team</a></li>
            <li><a href="backendMember/member/dblogin.php">My Team</a></li>
            <li><a href="backendMember/member/dblogin.php">Login</a></li>
        </ul>
    </nav>

    <section class="video-section">
        <video autoplay loop muted playsinline class="background-video">
            <source src="backendMember/icon/background/home-bg.mp4" type="video/mp4">
        </video>
        <h1 class="welcome-homepage" id="welcomeHomepage"></h1>
        <a class="btn-join" href="backendMember/member/dblogin.php">Login First!</a>
        <div class="background-2">
            <div class="content"> </div>
        </div>
        <div class="background-3">
            <div class="content"> </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const username = "<?php echo $username; ?>";
            const text = "Welcome, " + username + "! ";
            const element = document.getElementById("welcomeHomepage");
            let index = 0;

            function typeWriter() {
                if (index < text.length) {
                    element.textContent += text.charAt(index);
                    index++;
                    element.style.opacity = 1;
                    setTimeout(typeWriter, 150);
                }
            }

            typeWriter();
        });
    </script>

    <main class="main-content">
        <h2 class="section-title">Our Elite Team</h2>
        <?php
        echo '<div class="horizontal-scroll">';
        echo '<div class="container-img">';

        require_once("backendAdmin/models/team.php");
        require_once("backendAdmin/models/game.php");
        $team = new Team();
        $game = new Game();

        $result = $team->getAllTeam();
        while ($row = $result->fetch_assoc()) {
            $idteam = $row['idteam'];
            $name = $row['name'];
            $idgame = $row['idgame'];

            echo '<figure class="item">';
            $image = 'backendMember/icon/images/' . $idteam . '.jpg';
            if (file_exists($image)) {
                echo '<img src="' . $image . '">';
            } else {
                echo '<img src="backendMember/icon/images/index.png">';
            }


            $result2 = $game->getGameTeambyId($idgame);
            while ($row2 = $result2->fetch_assoc()) {
                $gameName = $row2['name'];
            }
            echo '<figcaption><strong>' . $name . '</strong><br>' . $gameName . '</figcaption>';
            echo '</figure>';
        }

        echo '</div>';
        echo '</div>';
        ?>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="backendMember/icon/logo.png" alt="Logo" class="footer-logo-image">
                <h3 class="footer-title">E-SPORT</h3>
                <p class="footer-subtitle">WEBSITE</p>
            </div>
            <p class="footer-description">
                Lets Join Us and Explore The World of Game!
            </p>
            <div class="footer-info">
                <p><i class="fas fa-map-marker-alt"></i> Address : Tenggilis Mejoyo, Rungkut, Surabaya</p>
                <p><i class="fas fa-phone-alt"></i> Phone : +62821635472824</p>
                <p><i class="fas fa-envelope"></i> Email : esport@gmail.com</p>
            </div>
        </div>
        <div class="footer-copyright">
            <p>by Salman & Ferdy</p>
        </div>
    </footer>

</body>
</html>