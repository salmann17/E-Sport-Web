<?php 
    require_once("../models/game.php");
    $game = new Game();
    $result = $game->getGameTeam();

    require_once("../models/achievement.php");
    $acv = new Achv();
    $result2 = $acv->getAllAcv();

    require_once("../models/event.php");
    $event= new Event();
    $result3 = $event->getAllEvent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Team</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>

    <h1>Insert Team</h1>

    <form action="insertteam_proses.php" method="POST">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" required> <br><br>

        <label for="name">Pilih Game:</label>
        <select name="idgames" id="idgames">
            <?php 
                while($row = $result->fetch_assoc()){
                    echo "<option value='".$row['idgame']."'>".$row['name']."</option>";

                }
            ?>
        </select><br><br>
        
        <label for="name">Pilih Achievement :</label>
        <select name="idacv" id="idacv">
            <?php 
                while($row2 = $result2->fetch_assoc()){
                    echo "<option value='".$row2['idachievement']."'>".$row2['name']."</option>";

                }
            ?>
        </select><br><br>

        <label for="name">Pilih Event :</label>
        <select name="idacv" id="idacv">
            <?php 
                while($row3 = $result3->fetch_assoc()){
                    echo "<option value='".$row3['idevent']."'>".$row3['name']."</option>";

                }
            ?>
        </select><br><br>
        <input type="submit" value="Submit Team" class="btn-add">
    </form>

</body>
</html>

