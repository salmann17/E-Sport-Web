<?php 
    require_once("parent.php");
    class TeamMembers extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function addTeamMembers($idteam, $idmember, $desc){
            $stt = $this->mysqli->prepare("insert into team_members (idteam, idmember, description) values(?,?,?)");
            $stt->bind_param("iis", $idteam, $idmember, $desc);
            $stt->execute();
        }
    }
?>