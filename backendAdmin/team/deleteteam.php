<?php 
    if(isset($_GET['idteam'])){
        $idteam = $_GET['idteam'];
    }
    require_once("../models/team.php");
    $team = new Team();

    $team->deleteTeam($idteam);

    header("location: ../dbteam.php");
?>