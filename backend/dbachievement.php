<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    if(isset($_GET['searchAcv'])){
        $acv= "%" . $_GET['searchAcv'] . "%";
        $statement = $mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                    inner join team as t on a.idteam = t.idteam where a.name LIKE ?");
        $statement->bind_param('s', $acv); 
    }else {
        $statement = $mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                    inner join team as t on a.idteam = t.idteam");
    }
    $statement-> execute();

    $result = $statement-> get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Achievement</title>
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

    <h1>Achievement Management</h1>
    <form action="" method="get">
        <input type="text" name="searchAcv" placeholder="input achievement name">
        <input type="submit" value="search" class="btn-add">
    </form>
    <a href="achievement/insertacv.php" class="btn-add">Tambah Achievement Baru</a>
    <?php 
        echo "<table><tr>
            <th>Nama Achievement</th>
            <th>Nama Team</th>
            <th>Date</th>
            <th>Daescription</th>
            <th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()){
            $idacv = $row['idachievement'];
            echo "<tr>";
            echo "<td>". $row['acv_name'] ."</td>";
            echo "<td>". $row['team_name'] ."</td>";
            echo "<td>". $row['date'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            echo "<td><a href='achievement/editacv.php?idacv=".$row['idachievement']."'>Ubah</a> | <a href='achievement/deleteacv.php?idacv=".$row['idachievement']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
    <input type="hidden" value="<?php echo $idacv;?>" name="idacv">
</body>
</html>
<?php
    $statement->close();
    $mysqli->close();
?>
