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
    if(isset($_GET['idteam'])){
        $idteam = $_GET['idteam'];
    }
    else{
        header("location: ..\dbteam.php");
    }
    require_once("../models/team.php");
    $team = new Team();

    $team->deleteTeam($idteam);

    header("location: ../dbteam.php");
?>