<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
	$path = $_SERVER['SCRIPT_NAME'];
	$queryString = $_SERVER['QUERY_STRING'];
	$url = "http://" . $domain . $path . "?" . $queryString;

	header("location: member/dblogin.php?url_asal=".$url);
    exit();
}

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: ../DashboardAdmin.php");
    exit();
}

?>