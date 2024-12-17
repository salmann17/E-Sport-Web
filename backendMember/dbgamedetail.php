<?php
// session_start();

// if (!isset($_SESSION['userid'])) {
//     $domain = $_SERVER['HTTP_HOST'];
// 	$path = $_SERVER['SCRIPT_NAME'];
// 	$queryString = $_SERVER['QUERY_STRING'];
// 	$url = "http://" . $domain . $path . "?" . $queryString;

// 	header("location: member/dblogin.php?url_asal=".$url);
//     exit();
// }

// if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
//     header("Location: ../DashboardAdmin.php");
//     exit();
// }

// $idmember = $_SESSION['userid'];


require_once("../backendAdmin/models/game.php");
$game= new Game();

$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['searchGame'])) {
    $searchgame = $_GET['searchGame'];
    $result = $game->getGame($searchgame, $limit, $offset);
    $total_records = $game->getTotalGames($searchgame);
} else {
    $result = $game->getGame("", $limit, $offset);
    $total_records = $game->getTotalGames();
}
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
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
        <h1>Game Detail</h1>
        <form action="" method="get">
            <input type="text" name="searchGame" placeholder="input game name">
            <input type="submit" value="search" class="btn-add"> <br><br>
        </form>

        <div class="card-grid">
            <?php
            $gameName = "";
            while ($row = $result->fetch_assoc()) {

                echo "<div class='card'>";

                echo "<h2 class='game-name' style='font-size:25px;'>" . $row['name'] . "</h2>";
                $gameName = $row['name'];
                
                $result2 = $game->gameDetail($gameName);
                while ($row2 = $result2->fetch_assoc()){
                    echo "<p class='team-info'>" . "<strong>" . $row2['team_name'] . "</strong>" . " <br> " . $row2['event_name'] . " <br> " .  date("d-m-Y", strtotime($row2['date'])) . "</p>"; 
                }
                
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <div class="pagination">
        <?php
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            echo "<a href='dbgamedetail.php?page=$prev_page&searchGame=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='dbgamedetail.php?page=$i&searchGame=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            echo "<a href='dbgamedetail.php?page=$next_page&searchGame=$search_param'>Next</a>";
        }
        ?>
    </div>
</body>

</html>