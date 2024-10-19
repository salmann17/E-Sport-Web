<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("location: dblogin.php?url_asal=" . $url);
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
            <li><a href="backendMember/dbevent.php">Event</a></li>
            <li><a href="backendMember/dbjointeam.php?idmember=<?php echo $idmember; ?>">Join Team</a></li>
            <li><a href="backendMember/dbevent.php">My Team</a></li>
            <li><a href="backendMember/member/dblogout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="video-section">
        <video autoplay loop muted playsinline class="background-video">
            <source src="backendMember/icon/background/home-bg.mp4" type="video/mp4">
        </video>
        <h1 class="welcome-homepage" id="welcomeHomepage"></h1>
        <a class="btn-join" href="backendMember/dbjointeam.php?idmember=<?php echo $idmember; ?>">Join Us</a>
        <div class="background-2">
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

    <!-- <div class="welcome-container">
        <h1>Selamat Datang, <?php echo $username; ?> </h1>
        <p>Selamat datang di tempat berkumpulnya para gamer sejati! Website ini kami rancang sebagai pusat bagi para gamer yang penuh gairah dan ambisi, seperti Anda, yang ingin menjadi bagian dari tim e-sport elit kami. Apakah Anda seorang pemain berpengalaman yang sudah banyak makan asam garam di dunia kompetisi, atau seorang pendatang baru dengan potensi besar, di sini Anda akan menemukan tempat untuk berkembang. Kami menawarkan berbagai divisi tim dalam berbagai genre game, yang semuanya memberikan kesempatan bagi Anda untuk mengasah keterampilan, berkompetisi dalam turnamen besar, dan terhubung dengan komunitas gamer yang luas dan bersemangat.</p>

        <p>Di platform ini, Anda tidak hanya sekadar bermain, tapi juga bisa bertumbuh dan berkolaborasi dengan pemain-pemain terbaik di dunia. Kami memahami bahwa e-sport bukan sekadar hobi, tapi sebuah profesi yang membutuhkan kerja keras, dedikasi, dan strategi yang matang. Oleh karena itu, kami menyediakan berbagai fasilitas dan wadah untuk membantu Anda mencapai potensi maksimal, mulai dari sesi latihan bersama, turnamen eksklusif, hingga strategi tim yang dirancang oleh pelatih profesional. Kami percaya bahwa setiap pemain memiliki kesempatan untuk bersinar dan berkontribusi dalam kemenangan tim.</p>

        <p>Tak hanya itu, di sini kami juga menekankan pentingnya sportivitas dan semangat tim. Bersama-sama, kita membangun lingkungan yang mendukung, di mana setiap gamer saling menginspirasi untuk menjadi lebih baik. Dengan dukungan komunitas yang solid, Anda akan mendapatkan pengalaman bermain yang lebih menyenangkan dan menantang. Jadi, jangan ragu untuk bergabung, ambil kesempatan, dan wujudkan mimpi menjadi atlet e-sport profesional. Bersama kita, bukan hanya game yang kita menangkan, tapi juga persahabatan dan pengalaman yang tak ternilai. Mari bersama-sama kita mendominasi medan pertempuran digital dan tunjukkan kepada dunia siapa yang terbaik!</p>
    </div> -->
</body>

</html>