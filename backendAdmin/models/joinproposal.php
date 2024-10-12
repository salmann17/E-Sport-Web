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
                                                where m.username LIKE ? LIMIT ? OFFSET ?");
                $stt->bind_param('sii', $proposal, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select * from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember
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
                                                where m.username LIKE ?");
                $stt->bind_param('s', $proposal);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }   
    }
?>