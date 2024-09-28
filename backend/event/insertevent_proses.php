<?php
    require_once("../models/event.php");
    $event = new Event();

    $name = $_POST['name'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];

    $last_id = $event->addEvent($name, $date, $desc);

    if(isset($_POST['team']))
    {
        $team = $_POST['team'];
        $result = $event->addEventWithTeam($team, $last_id);
    }

    header("Location: ../dbevent.php");
    exit();
?>