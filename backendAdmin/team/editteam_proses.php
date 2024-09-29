<?php 
    require_once("../models/team.php");
    $team = new Team();

    $nama = $_POST['name'];
    $idgame = $_POST['idgame'];
    $idteam = $_POST['idteam'];

    $result = $team->editTeam($nama, $idgame, $idteam);
    header("Location: ../dbteam.php");
    exit();
?>