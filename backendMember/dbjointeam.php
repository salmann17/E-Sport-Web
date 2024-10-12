<?php
session_start();
if (isset($_GET['idmember'])) {
    $idmember = $_GET['idmember'];
} else {
    header("Location: dblogin.php");
    exit();
}

require_once("../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['searchteam'])) {
    $searchteam = $_GET['searchteam'];
    $result = $teamMembers->getTeamMembers($searchteam, $limit, $offset);
    $total_records = $teamMembers->getTotalTeamMembers($searchteam);
} else {
    $result = $teamMembers->getTeamMembers("", $limit, $offset);
    $total_records = $teamMembers->getTotalTeamMembers();
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
            <h1>E-Sport<?php echo $idmember; ?></h1>
        </div>
        <ul class="nav-links">
            <li><a href="../DashboardMember.php">Home</a></li>
            <li><a href="dbteaminformation.php">Team Information</a></li>
            <li><a href="dbjointeam.php">Join Team</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Join Team</h1>
        <form action="" method="get">
            <input type="text" name="searchTeam" placeholder="input team name">
            <input type="submit" value="search" class="btn-add"> <br><br>
        </form>
        <?php
        echo "<table><tr>
            <th>Team</th>
            <th>Game</th>
            <th>Member</th>
            <th>Aksi</th>";
        while ($row = $result->fetch_assoc()) {
            $idteam = $row['idteam'];
            if (!isset($teams[$idteam])) {
                $teams[$idteam] = [
                    'teamname' => $row['teamname'],
                    'gamename' => $row['gamename'],
                    'members' => []
                ];
            }
            $teams[$idteam]['members'][] = $row['username'];
            echo "<tr>";
            echo "<td>" . $row['teamname'] . "</td>";
            echo "<td>" . $row['gamename'] . "</td>";
            echo "<td>" . implode(", ", $teams[$idteam]['members']) . "</td>";
            echo "<td><a href='member/joinproposal_proses.php?action=joinproposal=" . "idmember=" . $row['idmember'] . "'>Join Team</a></td>";
        }
        echo "</table>"
        ?>
    </div>

    <div class="pagination">
        <?php
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='?page=$prev_page&searchTeam=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='?page=$i&searchTeam=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchTeam']) ? $_GET['searchTeam'] : '';
            echo "<a href='?page=$next_page&searchTeam=$search_param'>Next</a>";
        }
        ?>
    </div>
</body>

</html>