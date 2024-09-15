<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    if(isset($_GET['searchEvent'])){
        $game = "%" . $_GET['searchEvent'] . "%";
        $statement = $mysqli->prepare("select * from event where name LIKE ?");
        $statement->bind_param('s', $game); 
    }else {
        $statement = $mysqli->prepare("select * from event");
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
        <input type="text" name="searchEvent" placeholder="input team name">
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="event/insertevent.php" class="btn-add">Tambah Game Baru</a>
    <?php 
        echo "<table><tr>
            <th></th>
            <th></th>
            <th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()){
            $idevent = $row['idevent'];
            echo "<tr>";
            echo "<td>". $row['name'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            echo "<td><a href='game/editgame.php?idgame=".$row['idevent']."'>Ubah</a> | <a href='game/deletegame.php?idgame=".$row['idevent']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <input type="hidden" value="<?php echo $idevent ;?>" name="idevent">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>
