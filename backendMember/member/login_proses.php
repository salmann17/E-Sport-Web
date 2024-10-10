<?php
session_start();
require_once("../../backendAdmin/models/member.php");
$member = new Member();

$username = $_POST['username'];
$password = $_POST['password'];

if ($member->Login($username, $password)) {
    $userku = $member->getMember($username, $password);
    $_SESSION['userid'] = $userku['idmember'];
    $_SESSION['role'] = $userku['profile'];
    $_SESSION['nama'] = $userku['fname'];
    if ($_SESSION['role'] == "admin") {
        $url_asal = isset($_POST['url_asal']) ? $_POST['url_asal'] : "../../DashboardAdmin.php";
    }
    else{
        $url_asal = isset($_POST['url_asal']) ? $_POST['url_asal'] : "../../DashboardMember.php";
    }
    header("location: " . $url_asal);
} else {
    header("location: dblogin.php?error=1");
}
exit();
?>