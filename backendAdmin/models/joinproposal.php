<?php 
    require_once("parent.php");
    class Proposal extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getProposal($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $proposal = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select * from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember
                                                where m.username LIKE ? && status='waiting' LIMIT ? OFFSET ?");
                $stt->bind_param('sii', $proposal, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select * from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember 
                                                where status='waiting'
                                                LIMIT ? OFFSET ?");
                $stt->bind_param('ii', $limit, $offset);
            }
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getTotalProposal($cari = "") {
            if (!empty($cari)) {
                $proposal = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select count(*) as total from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember
                                                where m.username LIKE ? status='waiting'");
                $stt->bind_param('s', $proposal);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember where status='waiting'");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }   
        public function proposalApproved($idmember){
            $stt = $this->mysqli->prepare("update join_proposal set status='approved' where idmember=?");
            $stt->bind_param('i', $idmember);
            $stt->execute();
        }
        public function proposalRejected($idmember){
            $stt = $this->mysqli->prepare("update join_proposal set status='rejected' where idmember=?");
            $stt->bind_param('i', $idmember);
            $stt->execute();
        }
    }
?>