<?php 
    if(isset($_GET['idacv'])){
        $idacv= $_GET['idacv'];
    }
    require_once("../models/achievement.php");
    $acv = new Achv();
    $result = $acv->deleteAcv($idacv);
    header("location: ../dbachievement.php");
?>