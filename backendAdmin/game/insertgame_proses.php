<?php 
    require_once("../models/game.php");
    $game = new Game();

    $nama = $_POST['name'];
    $desc = $_POST['desc'];

    $result = $game->addGame($nama, $desc);

    header("Location: ../dbgame.php");
    exit();
?>