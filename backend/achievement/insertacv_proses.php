<?php 
    require_once("../models/achievement.php");
    $acv = new Achv();

    $idteam = $_POST['idteam'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];

    $result = $acv->addAchv($idteam, $name, $date, $desc);

    header("Location: ../dbachievement.php");
    exit();
?>