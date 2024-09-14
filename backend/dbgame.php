<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    if(isset($_GET['searchGame'])){
        $game = "%" . $_GET['searchGame'] . "%";
        $statement = $mysqli->prepare("select * from game where name LIKE ?");
        $statement->bind_param('s', $game); 
    }else {
        $statement = $mysqli->prepare("select * from game");
    }
    $statement-> execute();

    $result = $statement-> get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Game</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h1>Game Management</h1>
    <form action="" method="get">
        <input type="text" name="searchGame" placeholder="input team name">
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="game/insertgame.php" class="btn-add">Tambah Game Baru</a>
    <?php 
        echo "<table><tr>
            <th>Nama Game</th>
            <th>Deskripsi</th>
            <th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()){
            $idgame = $row['idgame'];
            echo "<tr>";
            echo "<td>". $row['name'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            echo "<td><a href='game/editgame.php?idgame=".$row['idgame']."'>Ubah</a> | <a href='game/deletegame.php?idgame=".$row['idgame']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <input type="hidden" value="<?php echo $idgame ;?>" name="idgame">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>
