<?php
require_once("models/team.php");
$team = new Team();

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['searchTeam'])) {
    $searchTeam = $_GET['searchTeam'];
    $result = $team->getTeam($searchTeam, $limit, $offset);
    $total_records = $team->getTotalTeams($searchTeam);
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
    <title>Dashboard Team</title>
    <link rel="icon" href="icon/logo.png" type="image/png">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/paging.css">
    <style>
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

    <h1>Team Management</h1>
    <form action="" method="get">
        <input type="text" name="searchTeam" placeholder="input team name">
        <input type="submit" value="search" class="btn-add"> <br><br>
        <a href='team/insertteam.php' class='btn-add'>Tambah Team Baru</a>
    </form>
    <?php
    echo "<table><tr>
            <th>Nama Team</th>
            <th>Game</th>
            <th>Event</th>
            <th>Achievements</th>
            <th>Aksi</th>";
    while ($row = $result->fetch_assoc()) {
        $idteam = $row['idteam'];
        echo "<tr>";
        echo "<td>" . $row['team_name'] . "</td>";
        echo "<td>" . $row['game_name'] . "</td>";
        echo "<td>";
        $res = $team->getEventName($idteam);

        $eventname = [];
        while ($row2 = $res->fetch_assoc()) {
            if (!empty($row2['event_name'])) {
                $eventname[] = $row2['event_name'];
            }
        }
        if (!empty($eventname)) {
            echo implode(", ", $eventname);
        } else {
            echo "";
        }
        echo "</td>";

        echo "<td>";
        $res2 = $team->getAchievName($idteam);

        $achievename = [];
        while ($row3 = $res2->fetch_assoc()) {
            if (!empty($row3['achiev_name'])) {
                $achievename[] = $row3['achiev_name'];
            }
        }
        if (!empty($achievename)) {
            echo implode(", ", $achievename);
        } else {
            echo "-";
        }
        echo "</td>";
        echo "<td><a href='team/editteam.php?idteam=" . $row['idteam'] . "'>Ubah</a> | <a href='team/deleteteam.php?idteam=" . $row['idteam'] . "'>Hapus</a></td>";

    }
    echo "</table>"
        ?>
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
    <input type="hidden" value="<?php echo $idteam; ?>" name="idteam">
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>