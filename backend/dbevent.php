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
    <title>Dashboard Event</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <h1>Event Management</h1>
    <form action="" method="get">
        <input type="text" name="searchEvent" placeholder="input team name">
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="event/insertevent.php" class="btn-add">Tambah Game Baru</a>
    <?php 
        echo "<table><tr>
            <th>Nama Event</th>
            <th>Team yang Mengikuti</th>
            <th>Date</th>
            <th>Deskripsi</th>
            <th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()){
            $idevent = $row['idevent'];
            echo "<tr>";
            echo "<td>". $row['name'] ."</td>";
            // echo "<td>". $row['team_name'] ."</td>";
            echo "<td>";
            $stt2 = $mysqli->prepare("select t.idteam, t.name as team_name, et.idevent from team as t
                                    inner join event_teams as et on t.idteam = et.idteam where idevent=?");
            $stt2->bind_param("i", $idevent);
            $stt2->execute();
            $res = $stt2-> get_result();
            while($row2 = $res->fetch_assoc()){
                echo $row2['team_name'] . ", ";
            }
            echo "</td>";
            echo "<td>". $row['date'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            echo "<td><a href='event/editevent.php?idevent=".$row['idevent']."'>Ubah</a> | <a href='event/deleteevent.php?idevent=".$row['idevent']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <input type="hidden" value="<?php echo $idevent ;?>" name="idevent">
    <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>
