<?php

    session_start();
        
    if (!isset($_SESSION['userid'])) {
        $domain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['SCRIPT_NAME'];
        $queryString = $_SERVER['QUERY_STRING'];
        $url = "http://" . $domain . $path . "?" . $queryString;

        header("location: ..\..\backendMember\member\dblogin.php?url_asal=".$url);
        exit();
    }
    require_once("../models/joinproposal.php");
    require_once("../models/teammembers.php");  

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $idmember = $_GET['idmember'];
        $idteam = $_GET['idteam'];
        $joinProposal = new Proposal();
        $teamMember = new TeamMembers();

        if ($action == 'approved') {
            $desc = urldecode($_GET['desc']);
            
            $joinProposal->proposalApproved($idmember, $idteam);
            $teamMember->addTeamMembers($idteam, $idmember, $desc);

            echo "<script>alert('Member has been approved'); window.location.href='../dbjoinproposal.php';</script>";
            
        } elseif ($action == 'rejected') {
            $joinProposal = new Proposal();      
            $joinProposal->proposalRejected($idmember, $idteam);
            echo "<script>alert('Member has been rejected'); window.location.href='../dbjoinproposal.php';</script>";
        }
    }
    else{
        header("location: ..\dbjoinproposal.php");
    }
?>
