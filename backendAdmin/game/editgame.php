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
    if(isset($_GET['idgame'])){
        $idgame = $_GET['idgame'];
    }
    else{
        header("location: ..\dbgame.php");
    }
    require_once("../models/game.php");
    $game = new Game();

    $result = $game->getGameTeambyId($idgame);
    while($row = $result->fetch_assoc()){
        $name= $row['name'];
        $desc = $row['description'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>

    <h1>Edit Game</h1>

    <form action="editgame_proses.php" method="POST">
        <label for="name">Nama Game:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"> <br><br>

        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ><?php echo $desc; ?></textarea> <br> <br>
        <input type="submit" value="Submit Game" class="btn-add">
        <input type="hidden" value="<?php echo $idgame ;?>" name="idgame">
    </form>
</body>
</html>

