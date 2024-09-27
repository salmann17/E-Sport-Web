<?php 
    if(isset($_GET['idteam'])){
        $idteam = $_GET['idteam'];
    }
    require_once("../models/team.php");
    require_once("../models/game.php");
    $team = new Team();
    $game = new Game();


    $result = $team->getTeambyId($idteam);
    while($row = $result->fetch_assoc()){
        $idgame = $row['idgame'];
        $team_name = $row['name'];
    }

    
    $result2 = $game->getGameTeambyId($idgame);
    $selectGame = [];
    while($row2 = $result2->fetch_assoc()){
        $selectGame[] = $row2['idgame'];
    }
    $allgame = $game->getGameTeam();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="../css/insert.css">
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
