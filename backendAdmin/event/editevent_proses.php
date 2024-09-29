<?php
    $idevent = $_POST['idevent']; 
    $name = $_POST['name']; 
    $desc = $_POST['desc']; 
    $date = $_POST['date'];
    $new_teams = [];
    if(isset($_POST['team'])){
        $new_teams = $_POST['team'];
    }

    require_once("../models/event.php");
    $event = new Event();

    $event->updateEvent($idevent, $name, $desc, $date);
    $current_teams = $event->getCurrentTeams($idevent);
    $event->addTeams($idevent, $new_teams, $current_teams);
    $event->deleteTeams($idevent, $new_teams, $current_teams);

    header("Location: ../dbevent.php");
    exit();
?>