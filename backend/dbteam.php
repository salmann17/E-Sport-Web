<?php 
    require_once("models/team.php");
    $team = new Team();
    if(isset($_GET['searchTeam'])){
        $result = $team->getTeam($_GET['searchTeam']);
    } else{
        $result = $team->getTeam();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Team</title>
    <link rel="icon" href="icon/logo.png" type="image/png">
    <link rel="stylesheet" href="css/dashboard.css">
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
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="team/insertteam.php" class="btn-add">Tambah Team Baru</a>
    <?php 
        echo "<table><tr>
            <th>Nama Team</th>
            <th>Game</th>
            <th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()){
            $idteam = $row['idteam'];
            echo "<tr>";
            echo "<td>". $row['team_name'] ."</td>";
            echo "<td>". $row['game_name'] ."</td>";
            echo "<td><a href='team/editteam.php?idteam=".$row['idteam']."'>Ubah</a> | <a href='team/deleteteam.php?idteam=".$row['idteam']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>