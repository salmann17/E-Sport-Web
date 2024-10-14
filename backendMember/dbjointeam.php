<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
	$path = $_SERVER['SCRIPT_NAME'];
	$queryString = $_SERVER['QUERY_STRING'];
	$url = "http://" . $domain . $path . "?" . $queryString;

	header("location: dblogin.php?url_asal=".$url);
    exit();
}
if (isset($_GET['idmember'])) {
    $idmember = $_GET['idmember'];
}

require_once("../backendAdmin/models/team.php");
$team = new Team();

$limit = 5;
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
    <title>Join Team</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dbmember.css">
    <link rel="stylesheet" href="css/paging.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="icon/logo.png" alt="esport-logo">
        </div>
        <div class="title">
            <h1>E-Sport</h1>
        </div>
        <ul class="nav-links">
            <li><a href="../DashboardMember.php">Home</a></li>
            <li><a href="dbevent.php">Event</a></li>
            <li><a href="dbjointeam.php">Join Team</a></li>
            <li><a href="member/dblogout.php">My Team</a></li>
            <li><a href="member/dblogout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Join Team</h1>
        <form action="" method="get">
            <input type="text" name="searchTeam" placeholder="input team name">
            <input type="submit" value="search" class="btn-add"> <br><br>
            <input type="hidden" name="idmember" value="<?php echo $idmember ?>">
        </form>
        <?php
        echo "<table><tr>
            <th>Team</th>
            <th>Game</th>
            <th>Input Description</th>
            <th>Aksi</th>
            <th>Status</th>";
        while ($row = $result->fetch_assoc()) {
            $idteam = $row['idteam'];
            echo "<tr>";
            echo "<td>" . $row['team_name'] . "</td>";
            echo "<td>" . $row['game_name'] . "</td>";
            echo "<form action='member/joinproposal_proses.php' method='get'>";
            echo "<input type='hidden' name='action' value='joinproposal'>";
            echo "<input type='hidden' name='idmember' value='" . $idmember . "'>";
            echo "<input type='hidden' name='idteam' value='" . $idteam . "'>";
            echo "<td><input type='text' name='desc' placeholder='send your description'></td>";
            echo "<td><input type='submit' class='btn-add' value='Join Team'></td>";
            echo "</form>"; 

            require_once("../backendAdmin/models/joinproposal.php");
            $proposal = new Proposal();
            $result2 = $proposal->checkProposal($idmember, $idteam);
            $status = '';
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $status = $row2['status'];  
                }
            }
            echo "<td>" . ($status != '' ? $status : ' ') . "</td>";
            echo "</tr>";
        }
        echo "</table>"
        ?>
    </div>

    <div class="pagination">
        <?php
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='dbjointeam.php?page=$prev_page&idmember=$idmember&searchTeam=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='dbjointeam.php?page=$i&idmember=$idmember&searchTeam=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='dbjointeam.php?page=$next_page&idmember=$idmember&searchTeam=$search_param'>Next</a>";
        }
        ?>
    </div>
</body>

</html>