<?php
session_start();
require_once("../../backendAdmin/models/member.php");

$member = new Member();

$username = $_POST['username'];
$password = $_POST['password'];

$loginResult = $member->Login($username, $password);

if ($loginResult['status']) { 
    $idmember = $loginResult['idmember']; 
    $userku = $member->getMember($username, $password); 

    $_SESSION['userid'] = $idmember;
    $_SESSION['role'] = $userku['profile'];
    $_SESSION['nama'] = $userku['fname'];

    $url_asal = isset($_POST['url_asal']) ? $_POST['url_asal'] : '';

    if (empty($url_asal)) {
        if ($_SESSION['role'] == "admin") {
            $url_asal = "../../DashboardAdmin.php";
        } elseif ($_SESSION['role'] == "member") {
            $url_asal = "../../DashboardMember.php";
        }
    }

    header("location: " . $url_asal);
    exit();
} else {
    $url_asal = isset($_POST['url_asal']) ? $_POST['url_asal'] : '';
    header("location: dblogin.php?error=1&url_asal=" . $url_asal); 
    exit();
}
