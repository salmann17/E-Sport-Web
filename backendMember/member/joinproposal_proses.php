<?php 
    require_once("../../backendAdmin/models/joinproposal.php");

    if(isset($_GET['action'])){
        $idteam = $_GET['idteam'];
        $idmember = $_GET['idmember'];
        $desc = isset($_GET['desc']) ? urldecode($_GET['desc']) : '';

        $joinProposal = new Proposal();
        $checkProposal = $joinProposal->checkProposal($idmember, $idteam);

        while($row = $checkProposal->fetch_assoc()){
            if($checkProposal->num_rows > 0){
                if($row['status'] == 'approved'){
                    echo "<script>alert('you are already registered'); window.location.href='../dbjointeam.php?idmember=". $idmember ."';</script>";
                } elseif($row['status'] == 'rejected'){
                    echo "<script>alert('you have been rejected from this team'); window.location.href='../dbjointeam.php?idmember=". $idmember ."';</script>";
                } elseif($row['status'] == 'waiting'){
                    echo "<script>alert('your proposal has been sent, please wait until admin process your proposal'); window.location.href='../dbjointeam.php?idmember=". $idmember ."';</script>";
                }
            } else{
                $status = "waiting";
                $joinProposal->addProposal($idmember, $idteam, $desc, $status);
                echo "<script>alert('your proposal has been sent'); window.location.href='../dbjointeam.php?idmember=". $idmember ."';</script>";
            }
        }
    }
?>