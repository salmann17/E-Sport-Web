<?php 
    session_start();
    if(!isset($_SESSION['userid'])) {
        $domain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['SCRIPT_NAME'];
        $queryString = $_SERVER['QUERY_STRING'];
        $url = "http://" . $domain . $path . "?" . $queryString;

        header("location: login.php?url_asal=".$url);
    }
    require_once("models/achievement.php");
    $achv = new Achv();

    $limit = 5; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($page - 1) * $limit; 

    if (isset($_GET['searchAcv'])) {
        $searchAcv = $_GET['searchAcv'];
        $result = $achv->getAchv($searchAcv, $limit, $offset); 
        $total_records = $achv->getTotalAchv($searchAcv); 
    } else {
        $result = $achv->getAchv("", $limit, $offset); 
        $total_records = $achv->getTotalAchv(); 
    }
    $total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Achievement</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/paging.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
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
    <?php
        if ($_SESSION['role'] === 'Admin') {
            echo "<a href='achievement/insertacv.php' class='btn-add'>Tambah Achievement Baru</a>";
        }
    ?>
    <?php 
        echo "<table><tr>
            <th>Nama Achievement</th>
            <th>Nama Team</th>
            <th>Date</th>
            <th>Daescription</th>";
            if ($_SESSION['role'] === 'Admin') {
                echo "<th>Aksi</th>";
            }
        while($row = $result->fetch_assoc()){
            $idacv = $row['idachievement'];
            echo "<tr>";
            echo "<td>". $row['acv_name'] ."</td>";
            echo "<td>". $row['team_name'] ."</td>";
            echo "<td>". $row['date'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            if ($_SESSION['role'] === 'Admin') {
                echo "<td><a href='achievement/editacv.php?idacv=" . $row['idachievement'] . "'>Ubah</a> | 
                      <a href='achievement/deleteacv.php?idacv=" . $row['idachievement'] . "'>Hapus</a></td>";
            }
        }
        echo "</table>"
    ?>
    <div class="pagination">
        <?php 
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchAcv']) ? $_GET['searchAcv'] : '';
            echo "<a href='?page=$prev_page&searchAcv=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchAcv']) ? $_GET['searchAcv'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='?page=$i&searchAcv=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchAcv']) ? $_GET['searchAcv'] : '';
            echo "<a href='?page=$next_page&searchAcv=$search_param'>Next</a>";
        }
        ?>
    </div>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
    <input type="hidden" value="<?php echo $idacv;?>" name="idacv">
</body>
</html>

