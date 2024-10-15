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
    if(isset($_GET['idevent'])){
        $idevent = $_GET['idevent'];
    }
    else{
        header("location: ..\dbevent.php");
    }
    require_once("../models/event.php");
    $event = new Event($mysqli);
    $event->deleteEventTeams($idevent);
    $event->deleteEvent($idevent);
    header("Location: ../dbevent.php");
    exit();
?>