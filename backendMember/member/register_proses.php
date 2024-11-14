<?php
    require_once("../../backendAdmin/models/member.php");
    $member = new Member();

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $member->Register($fname, $lname, $username, $password);

    if ($result) {
        header("Location: dblogin.php");
        exit();
    } else {    
        header("Location: dbregister.php?error=username_exists");
        exit();
    }
?>
