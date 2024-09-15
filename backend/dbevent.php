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
                echo "<td>";
                
                $stt2 = $mysqli->prepare("select t.name as team_name from event e left join event_teams et on e.idevent = et.idevent left join team t on et.idteam = t.idteam where e.idevent = ?");
                $stt2->bind_param("i", $idevent);
                $stt2->execute();
                $res = $stt2->get_result();
            
                $teamNames = [];
                while($row2 = $res->fetch_assoc()){
                    if (!empty($row2['team_name'])) {
                        $teamNames[] = $row2['team_name'];
                    }
                }
            
                if (!empty($teamNames)) {
                    echo implode(", ", $teamNames);
                } else {
                    echo "";
                }
            
                echo "</td>";
                echo "<td>". $row['date'] ."</td>";
                echo "<td>". $row['description'] ."</td>";
                echo "<td><a href='event/editevent.php?idevent=".$row['idevent']."'>Ubah</a> | <a href='event/deleteevent.php?idevent=".$row['idevent']."'>Hapus</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            
    ?>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
    <input type="hidden" value="<?php echo $idevent ;?>" name="idevent">
    <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>
