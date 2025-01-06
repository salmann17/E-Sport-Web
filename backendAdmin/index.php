<?php
session_start();

if (!isset($_SESSION['userid'])) {
    // $domain = $_SERVER['HTTP_HOST'];
    // $path = $_SERVER['SCRIPT_NAME'];
    // $queryString = $_SERVER['QUERY_STRING'];
    // $url = "http://" . $domain . $path . "?" . $queryString;

    // header("location: backendMember\member\dblogin.php?url_asal=".$url);
    header("Location: ../Homepage.php");
    exit();
}
else{
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'member') {
        header("Location: ../DashboardMember.php");
        exit();
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: ../DasboardAdmin.php");
        exit();
    }
}


?>