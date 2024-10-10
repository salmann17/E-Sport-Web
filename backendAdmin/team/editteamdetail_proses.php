<?php
require_once("../models/achievement.php");
require_once("../models/event.php");
$acv = new Achv();
$evt = new Event();

if (isset($_POST['idteam'])) {
    $idteam = $_POST['idteam'];
    if (isset($_POST['nameachv'])) {
        $nameachv = $_POST['nameachv'];
        $dateachv = $_POST['dateachv'];
        $descachv = $_POST['descachv'];
    }

    if (isset($_POST['achv'])) {
        $new_achv = $_POST['achv'];
    } else {
        $new_achv = [];
    }
    
    $current_achv = $acv->getAchvbyTeamId($idteam);
    
    $current_achv_ids = [];
    while ($row = $current_achv->fetch_assoc()) {
        $current_achv_ids[] = $row['idachievement'];
    }
    
    if (empty($new_achv)) {
        $acv->deleteAllAcv($idteam);
    } else {
        $acv->deleteAchievementbyTeam($idteam, $new_achv, $current_achv_ids);
    }


    foreach ($nameachv as $index => $name) {
        $date = $dateachv[$index];
        $desc = $descachv[$index];

        $result = $acv->addAchv($idteam, $name, $date, $desc);
    }
    $new_events = [];
    if (isset($_POST['event'])) {
        $new_events = $_POST['event'];
    }

    $current_event = $evt->getCurrentEvent($idteam);
    $evt->addEvents($idteam, $new_events, $current_event);
    $evt->deleteEvents($idteam, $new_events, $current_event);

}


header("Location: ../dbteam.php");
exit();
?>