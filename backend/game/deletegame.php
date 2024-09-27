<?php 
    if(isset($_GET['idgame'])){
        $idgame = $_GET['idgame'];
    }
    require_once("../models/game.php");
    $game = new Game();
    $game->deleteGame($idgame);
    
    header("location: ../dbgame.php");
?>