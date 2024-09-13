<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>E-Sport Admin Dashboard</h1>
        <div class="menu">
            <div class="menu-item">
                <a href="dbteam.php">Team</a>
            </div>
            <div class="menu-item">
                <a href="dbgame.php">Game</a>
            </div>
            <div class="menu-item">
                <a href="dbachievement.php">Achievement</a>
            </div>
            <div class="menu-item">
                <a href="dbevent.php">Event</a>
            </div>
        </div>
    </div>
</body>
</html>
