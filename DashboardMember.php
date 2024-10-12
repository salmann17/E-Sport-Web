<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: dblogin.php");
    exit();
}
$idmember = $_SESSION['userid'];

require_once("backendAdmin/models/member.php");
$member = new Member();
$result = $member->getMemberbyId($idmember);
while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
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
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="backendMember/icon/logo.png" alt="esport-logo">
        </div>
        <div class="title">
            <h1>E-Sport</h1>
        </div>
        <ul class="nav-links">
            <li><a href="DashboardMember.php">Home</a></li>
            <li><a href="backendMember/dbevent.php">Event</a></li>
            <li><a href="backendMember/dbjointeam.php?idmember=<?php echo $idmember; ?>">Join Team</a></li>
            <li><a href="backendMember/member/dblogout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <h2>Team List</h2>
        <div class="horizontal-scroll">
            <div class="container-img">
                <div class="item">
                    <img src="backendMember/icon/images/1.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/2.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/3.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/4.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/5.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/6.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/7.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/8.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/9.jpg" alt="">
                </div>
                <div class="item">
                    <img src="backendMember/icon/images/10.jpg" alt="">
                </div>
            </div>
        </div>
    </main>
    <div class="welcome-container">
    <h1>Selamat Datang, <?php echo $username; ?> </h1>
        <p>Selamat datang di tempat berkumpulnya para gamer sejati! Website ini kami rancang sebagai pusat bagi para gamer yang penuh gairah dan ambisi, seperti Anda, yang ingin menjadi bagian dari tim e-sport elit kami. Apakah Anda seorang pemain berpengalaman yang sudah banyak makan asam garam di dunia kompetisi, atau seorang pendatang baru dengan potensi besar, di sini Anda akan menemukan tempat untuk berkembang. Kami menawarkan berbagai divisi tim dalam berbagai genre game, yang semuanya memberikan kesempatan bagi Anda untuk mengasah keterampilan, berkompetisi dalam turnamen besar, dan terhubung dengan komunitas gamer yang luas dan bersemangat.</p>

        <p>Di platform ini, Anda tidak hanya sekadar bermain, tapi juga bisa bertumbuh dan berkolaborasi dengan pemain-pemain terbaik di dunia. Kami memahami bahwa e-sport bukan sekadar hobi, tapi sebuah profesi yang membutuhkan kerja keras, dedikasi, dan strategi yang matang. Oleh karena itu, kami menyediakan berbagai fasilitas dan wadah untuk membantu Anda mencapai potensi maksimal, mulai dari sesi latihan bersama, turnamen eksklusif, hingga strategi tim yang dirancang oleh pelatih profesional. Kami percaya bahwa setiap pemain memiliki kesempatan untuk bersinar dan berkontribusi dalam kemenangan tim.</p>

        <p>Tak hanya itu, di sini kami juga menekankan pentingnya sportivitas dan semangat tim. Bersama-sama, kita membangun lingkungan yang mendukung, di mana setiap gamer saling menginspirasi untuk menjadi lebih baik. Dengan dukungan komunitas yang solid, Anda akan mendapatkan pengalaman bermain yang lebih menyenangkan dan menantang. Jadi, jangan ragu untuk bergabung, ambil kesempatan, dan wujudkan mimpi menjadi atlet e-sport profesional. Bersama kita, bukan hanya game yang kita menangkan, tapi juga persahabatan dan pengalaman yang tak ternilai. Mari bersama-sama kita mendominasi medan pertempuran digital dan tunjukkan kepada dunia siapa yang terbaik!</p>
    </div>
</body>

</html>