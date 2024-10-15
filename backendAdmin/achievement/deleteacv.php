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

    if(isset($_GET['idacv'])){
        $idacv= $_GET['idacv'];
    }
    else{
        header("location: ..\dbachievement.php");
    }
    require_once("../models/achievement.php");
    $acv = new Achv();
    $result = $acv->deleteAcv($idacv);
    header("location: ../dbachievement.php");
?>