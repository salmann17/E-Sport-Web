<?php
    session_start();
    require_once("../models/member.php");
    $member = new Member();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $url_asal = isset($_POST['url_asal']) ? $_POST['url_asal'] : "../../DashboardAdmin.php";

    if($member->Login($username, $password)) {
        $userku = $member->getMember($username, $password);
        $_SESSION['userid'] = $userku['idmember'];
        $_SESSION['role'] =$userku['profile'];
        $_SESSION['nama'] =$userku['fname'];
        header("location: ". $url_asal);
    } else {
        header("location: login.php?error=1");
    }
    exit();
?>