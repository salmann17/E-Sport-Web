<?php 
    require_once("../models/team.php");
    $team = new Team();

    $nama = $_POST['name'];
    $idgame = $_POST['idgames'];
    
    $result = $team->addTeam($nama, $idgame);
    header("Location: ../dbteam.php");
    exit();
?>