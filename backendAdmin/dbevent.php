<?php 
    session_start();
    
    if (!isset($_SESSION['userid'])) {
        $domain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['SCRIPT_NAME'];
        $queryString = $_SERVER['QUERY_STRING'];
        $url = "http://" . $domain . $path . "?" . $queryString;
    
        header("location: ..\backendMember\member\dblogin.php?url_asal=".$url);
        exit();
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'member') {
        header("Location: ../DashboardMember.php");
        exit();
    }
    require_once("models/event.php");
    $event = new Event();

    $limit = 5; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($page - 1) * $limit; 

    if (isset($_GET['searchEvent'])) {
        $searchEvent = $_GET['searchEvent'];
        $result = $event->getEvent($searchEvent, $limit, $offset); 
        $total_records = $event->getTotalEvents($searchEvent); 
    } else {
        $result = $event->getEvent("", $limit, $offset); 
        $total_records = $event->getTotalEvents(); 
    }
    $total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Event</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/paging.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
</head>
<body>

    <h1>Event Management</h1>
    <form action="" method="get">
        <input type="text" name="searchEvent" placeholder="input team name">
        <input type="submit" value="search" class="btn-add"> <br><br>
        <a href='event/insertevent.php' class='btn-add'>Tambah Event Baru</a>
    </form>
    <?php
        echo "<table><tr>
            <th>Nama Event</th>
            <th>Team yang Mengikuti</th>
            <th>Date</th>
            <th>Deskripsi</th>
            <th>Aksi</th>";
            while($row = $result->fetch_assoc()){
                $idevent = $row['idevent'];
                echo "<tr>";
                echo "<td>". $row['name'] ."</td>";
                echo "<td>";

                $res = $event->getEventTeam($idevent);
            
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
    <div class="pagination">
        <?php 
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchEvent']) ? $_GET['searchEvent'] : '';
            echo "<a href='?page=$prev_page&searchEvent=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchEvent']) ? $_GET['searchEvent'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='?page=$i&searchEvent=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchEvent']) ? $_GET['searchEvent'] : '';
            echo "<a href='?page=$next_page&searchEvent=$search_param'>Next</a>";
        }
        ?>
    </div>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
    <input type="hidden" value="<?php echo $idevent ;?>" name="idevent">
    <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
</body>
</html>

