<?php 
    session_start();
    
    if (!isset($_SESSION['userid'])) {
        $domain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['SCRIPT_NAME'];
        $queryString = $_SERVER['QUERY_STRING'];
        $url = "http://" . $domain . $path . "?" . $queryString;
    
        header("location: ..\..\backendMember\member\dblogin.php?url_asal=".$url);
        exit();
    }
    require_once("../models/team.php");
    $eventTeam = new Team();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Event</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>

    <h1>Insert Event</h1>

    <form action="insertevent_proses.php" method="POST">
        <label for="name">Nama Event:</label>
        <input type="text" id="name" name="name" required> <br><br>
        <label for="">Team yang Mengikuti:</label> <br>
            <?php 
                $result = $eventTeam->getAllTeam();
                while($row = $result->fetch_assoc()) {
                    echo '<input type="checkbox" name="team[]" value="'. $row['idteam']. '">'. $row['name'] . "<br>" ;
                }
            ?> <br><br>
        <label for="date">Date: </label>
        <input type="date" name="date" id="date"><br><br>
        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ></textarea> <br> <br>
        <input type="submit" value="Submit Achievement" class="btn-add">
    </form>
</body>
</html>

