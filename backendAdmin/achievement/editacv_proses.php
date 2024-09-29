<?php 
    require_once("../models/achievement.php");
    $acv = new Achv();

    $idacv = $_POST['idacv'];
    $acv_name = $_POST['name'];
    $idteam = $_POST['idteam'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];

    $result = $acv->editAcv($acv_name, $idteam, $date, $desc, $idacv);

    header("Location: ../dbachievement.php");
    exit();
?>