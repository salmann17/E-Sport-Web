<?php 
    if(isset($_GET['idteam'])){
        $idteam = $_GET['idteam'];
    }
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $stt = $mysqli->prepare("select * from team where idteam=?");
    $stt->bind_param("i", $idteam);
    $stt->execute();
    $result = $stt->get_result();
    while($row = $result->fetch_assoc()){
        $idgame = $row['idgame'];
        $team_name = $row['name'];
    }
    $stt->close();
    
    $stt2 = $mysqli->prepare("select * from game where idgame=?");
    $stt2->bind_param("i", $idgame);
    $stt2->execute();
    $result2 = $stt2->get_result();
    $selectGame = [];
    while($row2 = $result2->fetch_assoc()){
        $selectGame[] = $row2['idgame'];
    }
    $stt2->close();
    $allgame = $mysqli->query("select * from game");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="insert.css">
</head>
<body>
    <h1>Edit Team</h1>

    <form action="editteam_proses.php" method="POST">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" value="<?php echo $team_name; ?>"> <br><br>

        <select name="idgame" id="idgame">
            <?php 
                while($gameRow = $allgame->fetch_assoc()){
                    $selected = in_array($gameRow['idgame'], $selectGame) ? "selected" : "";
                    echo "<option value='" . $gameRow['idgame'] . "' $selected>" . $gameRow['name'] . "</option>";
                }
            ?>
        </select>

        <input type="submit" value="Submit Team" class="btn-add">
        <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
    </form>
</body>
</html>
<?php
    $mysqli->close();
?>
