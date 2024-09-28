<?php 
    require_once("../models/event.php");
    $event = new Event();

    if($_GET['idevent']){
        $idevent = $_GET['idevent'];
        $result = $event->getEventbyId($idevent);
    }
    while($row = $result->fetch_assoc()){
        $event_name= $row['name'];
        $desc = $row['description'];
        $date = $row['date'];
    }

    $res = $event->getEventTeambyId($idevent);
    $selectTeam = [];
    while($row2 = $res->fetch_assoc()){
        $selectTeam[] = $row2['idteam'];
    }
    
    require_once("../models/team.php");
    $team = new Team();
    $allteam = $team->getAllTeam();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>

    <h1>Edit Event</h1>

    <form action="editevent_proses.php" method="POST">
        <input type="hidden" name="idevent" value="<?= $idevent; ?>">
        <label for="name">Nama Event:</label>
        <input type="text" id="name" name="name" value="<?php echo $event_name?>"> <br><br>
        <label for="">Team yang Mengikuti:</label> <br>
            <?php 
                while($teamrow = $allteam->fetch_assoc()) {
                    $checked = in_array($teamrow['idteam'], $selectTeam) ? "checked" : "";
                    echo "<input type='checkbox' name='team[]' value='" . $teamrow['idteam'] . "' $checked> " . $teamrow['name'] . "<br>";
                }
            ?> <br><br>
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo $date ?>"><br><br>
        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ><?php echo $desc ?></textarea> <br> <br>
        <input type="submit" value="Submit Achievement" class="btn-add">
    </form>
</body>
</html>

