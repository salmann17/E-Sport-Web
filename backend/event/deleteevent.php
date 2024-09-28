<?php
    if(isset($_GET['idevent'])){
        $idevent = $_GET['idevent'];
    }
    require_once("../models/event.php");
    $event = new Event($mysqli);
    $event->deleteEventTeams($idevent);
    $event->deleteEvent($idevent);
    header("Location: ../dbevent.php");
    exit();
?>