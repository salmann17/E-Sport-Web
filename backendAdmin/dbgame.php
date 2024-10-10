<?php 
    require_once("models/game.php");
    $game = new Game();

    $limit = 5; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($page - 1) * $limit; 

    if (isset($_GET['searchGame'])) {
        $searchGame = $_GET['searchGame'];
        $result = $game->getGame($searchGame, $limit, $offset); 
        $total_records = $game->getTotalGames($searchGame); 
    } else {
        $result = $game->getGame("", $limit, $offset); 
        $total_records = $game->getTotalGames(); 
    }
    $total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Game</title>
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

    <h1>Game Management</h1>
    <form action="" method="get">
        <input type="text" name="searchGame" placeholder="input team name">
        <input type="submit" value="search" class="btn-add">
        <a href='game/insertgame.php' class='btn-add'>Tambah Game Baru</a>
    </form>
    <?php
        echo "<table><tr>
            <th>Nama Game</th>
            <th>Deskripsi</th>
            <th>Aksi</th>";
        while($row = $result->fetch_assoc()){
            $idgame = $row['idgame'];
            echo "<tr>";
            echo "<td>". $row['name'] ."</td>";
            echo "<td>". $row['description'] ."</td>";
            echo "<td><a href='game/editgame.php?idgame=".$row['idgame']."'>Ubah</a> | <a href='game/deletegame.php?idgame=".$row['idgame']."'>Hapus</a></td>";
        }
        echo "</table>"
    ?>
    <div class="pagination">
        <?php 
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            echo "<a href='?page=$prev_page&searchGame=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='?page=$i&searchGame=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchGame']) ? $_GET['searchGame'] : '';
            echo "<a href='?page=$next_page&searchGame=$search_param'>Next</a>";
        }
        ?>
    </div>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
    <input type="hidden" value="<?php echo $idgame ;?>" name="idgame">
</body>
</html>

