<?php
session_start();

if (isset($_SESSION['userid'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: ../DashboardAdmin.php");
        exit();
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] === 'member') {
        header("Location: ../DashboardAdmin.php");
        exit();
    }
}

require_once("../backendAdmin/models/team.php");
$team= new team();

$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['searchTeam'])) {
    $searchteam = $_GET['searchTeam'];
    $result = $team->getTeam($searchteam, $limit, $offset);
    $total_records = $team->getTotalTeams($searchteam);
} else {
    $result = $team->getTeam("", $limit, $offset);
    $total_records = $team->getTotalTeams();
}
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Detail</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dbmember.css">
    <link rel="stylesheet" href="css/paging.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="icon/logo.png" alt="esport-logo">
        </div>
        <ul class="nav-links">
            <li><a href="../Homepage.php">Home</a></li>
            <li><a href="dbgamedetail.php">Game Detail</a></li>
            <li><a href="dbteamdetail.php">Team Detail</a></li>
            <li><a href="member/dblogin.php">Login</a></li>
        </ul>
    </nav>

    <div class="container" style="margin-top: 100px !important;">
        <h1>Team Detail</h1>
        <form action="" method="get">
            <input type="text" name="searchTeam" placeholder="input team name">
            <input type="submit" value="search" class="btn-add"> <br><br>
        </form>

        <div class="card-grid">
            <?php
            while ($row = $result->fetch_assoc()) {

                echo "<div class='card'>";
                echo "<h2 class='game-name' style='font-size:25px;'>" . $row['team_name'] . "</h2><br>";
                $teamName = $row['team_name'];
                $idteam = $row['idteam'];

                require_once("../backendAdmin/models/teammembers.php");
                $teammembers= new TeamMembers();
                $result2 = $teammembers->getMemberByTeam($teamName);
                echo "<p class='team-info' style='font-size:20px;'>" . "<strong>" . "Team Members" . "</strong>" .  "</p>";
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        echo "<p class='team-info'>" . $row2['username'] . "</p>";
                    }
                } else {
                    echo "<p class='no-event' style='color:red;'>This team has no member</p>";
                }
                echo "<br>";

                require_once("../backendAdmin/models/achievement.php");
                $acv= new Achv();
                $result5 = $acv->getAchvbyTeamId($idteam);
                echo "<p class='team-info' style='font-size:20px;'>" . "<strong>" . "Achievement" . "</strong>" .  "</p>";
                if ($result5->num_rows > 0) {
                    while ($row5 = $result5->fetch_assoc()) {
                        echo "<p class='team-info'>" . $row5['acv_name'] . "</p>";
                    }
                } else {
                    echo "<p class='no-event' style='color:red;'>This team has no achievement</p>";
                }
                echo "<br>";

                require_once("../backendAdmin/models/event.php");
                $event= new Event();
                $result3 = $event->getCurEventByTeam($teamName);
                echo "<p class='team-info' style='font-size:20px;'>" . "<strong>" . "Next Event" . "</strong>" .  "</p>";
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        echo "<p class='team-info'>" . $row3['event_name'] . "</p>";
                    }
                } else {
                    echo "<p class='no-event' style='color:red;'>This team has no future event</p>";
                }
                echo "<br>";

                $result4 = $event->getOldEventByTeam($teamName);
                echo "<p class='team-info' style='font-size:20px;'>" . "<strong>" . "Previous Event" . "</strong>" .  "</p>";
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                        echo "<p class='team-info'>" . $row4['event_name'] . "</p>";
                    }
                } else {
                    echo "<p class='no-event' style='color:red;'>This team has no previous event</p>";
                }
                echo "<br>";
                
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <div class="pagination">
        <?php
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='dbteamdetail.php?page=$prev_page&searchTeam=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='dbteamdetail.php?page=$i&searchTeam=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='dbteamdetail.php?page=$next_page&searchTeam=$search_param'>Next</a>";
        }
        ?>
    </div>
</body>

</html>