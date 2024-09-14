<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    if(isset($_GET['searchTeam'])){
        $team = "%" . $_GET['searchTeam'] . "%";
        $statement = $mysqli->prepare("select idteam, t.name as team_name, g.name as game_name from team as t
                    inner join game as g on t.idgame = g.idgame where t.name LIKE ?");
        $statement->bind_param('s', $team); 
    }else {
        $statement = $mysqli->prepare("select idteam, t.name as team_name, g.name as game_name from team as t
                    inner join game as g on t.idgame = g.idgame");
    }
    $statement-> execute();

    $result = $statement-> get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Team</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <h1>Team Management</h1>
    <form action="" method="get">
        <input type="text" name="searchTeam" placeholder="input team name">
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="insertteam.php" class="btn-add">Tambah Team Baru</a>
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
            echo "<td><a href='editteam.php?idteam=".$row['idteam']."'>Ubah</a> | <a href='hapusteam.php?idteam=".$row['idteam']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>