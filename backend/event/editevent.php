<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }
    if($_GET['idevent']){
        $idevent = $_GET['idevent'];
    }
    $stt = $mysqli->prepare("select * from event where idevent=?");
    $stt->bind_param("i", $idevent);
    $stt->execute();
    $result = $stt->get_result();
    while($row = $result->fetch_assoc()){
        $event_name= $row['name'];
        $desc = $row['description'];
        $date = $row['date'];
    }
    $stt->close();

    $stt2 = $mysqli->prepare("select t.idteam, t.name as team_name, et.idevent from team as t
                                inner join event_teams as et on t.idteam = et.idteam where idevent=?");
    $stt2->bind_param("i", $idevent);
    $stt2->execute();
    $res = $stt2->get_result();
    $selectTeam = [];
    while($row2 = $res->fetch_assoc()){
        $selectTeam[] = $row2['idteam'];
    }
    $stt2->close();

    $allteam = $mysqli -> query("select * from team");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Achievement</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>

    <h1>Insert Event</h1>

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
<?php
    $mysqli->close();
?>
