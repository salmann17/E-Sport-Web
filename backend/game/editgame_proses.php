<?php 
    require_once("../models/game.php");
    $game = new Game();

    $idgame = $_POST['idgame'];
    $nama = $_POST['name'];
    $desc = $_POST['desc'];
    
    $result = $game->editGame($nama, $desc, $idgame);

    header("Location: ../dbgame.php");
    exit();
?>