<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="backend/icon/logo.png" type="image/png">
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
        .dashboard {
            text-align: center;
        }
        h1 {
            color: #00d4ff;
        }
        .menu {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }
        .menu-item {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 10px;
            width: 150px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .menu-item:hover {
            background-color: #00d4ff;
        }
        .menu-item a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff0000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.7);
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #d40000;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Dahboard Admin</h1>
        <!-- <h1>E-Sport Admin Dashboard</h1> -->
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
        </div>
        <a href="backendMember/member/dblogout.php" class="logout-btn">Log Out</a>
    </div>
</body>
</html>
