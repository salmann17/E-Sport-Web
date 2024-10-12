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
    while($row = $result->fetch_assoc()){
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
    <link rel="icon" href="backendMember/icon/logo.png" type="image/png">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="backendMember/icon/logo.png" alt="esport-logo">
        </div>
        <div class="title">
            <h1>E-Sport <?php echo $idmember; ?></h1>
        </div>
        <ul class="nav-links">
            <li><a href="DashboardMember.php">Home</a></li>
            <li><a href="backendMember/dbevent.php">Event</a></li>
            <li><a href="backendMember/dbjointeam.php?idmember=<?php echo $idmember; ?>">Join Team</a></li>
            <li><a href="backendMember/member/dblogout.php">Logout</a></li>
        </ul>
    </nav>
</body>

</html>