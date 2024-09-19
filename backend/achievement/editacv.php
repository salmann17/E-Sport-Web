<?php 
    if(isset($_GET['idacv'])){
        $idacv = $_GET['idacv'];
    }
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $stt = $mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                    inner join team as t on a.idteam = t.idteam where a.idachievement = ?");
    $stt->bind_param("i", $idacv);
    $stt->execute();
    $result = $stt->get_result();
    $selectTeam = [];
    while($row = $result->fetch_assoc()){
        $idteam = $row['idteam'];
        $acv_name = $row['acv_name'];
        $team_name = $row['team_name'];
        $date = $row['date'];
        $desc = $row['description'];
        $selectTeam[] = $row['idteam'];
    }
    $stt->close();
    $allteam = $mysqli->query("select * from team");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>
    <h1>Edit Achievement</h1>

    <form action="editacv_proses.php" method="POST">
        <label for="name">Nama Achievement:</label>
        <input type="text" id="name" name="name" value="<?php echo $acv_name ?>"> <br><br>
        <label for="name">Nama Team:</label>
        <select name="idteam" id="idteam">
        <?php 
                while($teamRow = $allteam->fetch_assoc()){
                    $selected = in_array($teamRow['idteam'], $selectTeam) ? "selected" : "";
                    echo "<option value='" . $teamRow['idteam'] . "' $selected>" . $teamRow['name'] . "</option>";
                }
            ?>
        </select> <br><br>
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo $date; ?>"><br><br>
        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ><?php echo $desc; ?></textarea> <br> <br>
        <input type="submit" value="Submit Achievement" class="btn-add">
        <input type="hidden" value="<?php echo $idacv;?>" name="idacv">
    </form>
</body>
</html>
<?php
    $mysqli->close();
?>
