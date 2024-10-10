<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="backendMember/icon/logo.png" type="image/png">
    <link rel="stylesheet" href="backendadmin/css/dashboard.css">
    <title>E-Sport Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1b1b1b;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Dahboard Admin</h1>
        <div class="menu">
            <div class="menu-item">
                <a href="backendAdmin/dbteam.php">Team</a>
            </div>
            <div class="menu-item">
                <a href="backendAdmin/dbgame.php">Game</a>
            </div>
            <div class="menu-item">
                <a href="backendAdmin/dbachievement.php">Achievement</a>
            </div>
            <div class="menu-item">
                <a href="backendAdmin/dbevent.php">Event</a>
            </div>
            <div class="menu-item">
                <a href="backendAdmin/dbjoinproposal.php">Proposal</a>
            </div>
        </div>
        <a href="backendMember/member/dblogout.php" class="logout-btn">Log Out</a>
    </div>
</body>

</html>