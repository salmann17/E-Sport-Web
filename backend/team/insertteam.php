<?php 
    require_once("../models/game.php");
    $game = new Game();
    $result = $game->getGameTeam();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Team</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>

    <h1>Insert Team</h1>

    <form action="insertteam_proses.php" method="POST">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" required> <br><br>

        <select name="idgames" id="idgames">
            <?php 
                while($row = $result->fetch_assoc()){
                    echo "<option value='".$row['idgame']."'>".$row['name']."</option>";

                }
            ?>
        </select>

        <input type="submit" value="Submit Team" class="btn-add">
    </form>

</body>
</html>

