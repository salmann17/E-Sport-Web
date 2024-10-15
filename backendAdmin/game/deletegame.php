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
    $game->deleteGame($idgame);
    
    header("location: ../dbgame.php");
?>