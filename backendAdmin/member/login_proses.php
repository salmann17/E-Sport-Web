<?php
    require_once("../models/member.php");
    $member = new Member();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $last_id = $member->Login($username, $password);

    if(isset($_POST['team']))
    {
        $team = $_POST['team'];
        $result = $event->addEventWithTeam($team, $last_id);
    }

    header("Location: ../dbevent.php");
    exit();
?>