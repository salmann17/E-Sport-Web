<?php
    require_once("../models/joinproposal.php");
    require_once("../models/teammembers.php");  

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $idmember = $_GET['idmember'];
        
        if ($action == 'approved') {
            $idteam = $_GET['idteam'];
            $desc = urldecode($_GET['desc']);
            
            $joinProposal = new Proposal();
            $teamMember = new TeamMembers();

            $joinProposal->proposalApproved($idmember, $idteam);
            $teamMember->addTeamMembers($idteam, $idmember, $desc);

            echo "<script>alert('Member has been approved'); window.location.href='../dbjoinproposal.php';</script>";
            
        } elseif ($action == 'rejected') {
            $joinProposal = new Proposal();
            $joinProposal->proposalRejected($idmember, $idteam);
            echo "<script>alert('Member has been rejected'); window.location.href='../dbjoinproposal.php';</script>";
        }
    }
?>
