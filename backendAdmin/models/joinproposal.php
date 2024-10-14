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
                $stt = $this->mysqli->prepare("select concat(m.fname, ' ', m.lname) as membername, jp.idjoin_proposal,jp.idmember, jp.idteam, t.name as teamname, jp.description, g.name as gamename from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember 
                                                inner join team as t on jp.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                where concat(m.fname, ' ', m.lname) LIKE ? and jp.status='waiting' LIMIT ? OFFSET ?");
                $stt->bind_param('sii', $proposal, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select concat(m.fname, ' ', m.lname) as membername, jp.idjoin_proposal,jp.idmember, jp.idteam, t.name as teamname, jp.description, g.name as gamename from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember 
                                                inner join team as t on jp.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
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
                                                inner join team as t on jp.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                where  concat(m.fname, ' ', m.lname) LIKE ? and jp.status='waiting'");
                $stt->bind_param('s', $proposal);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from join_proposal as jp
                                                inner join member as m on jp.idmember = m.idmember 
                                                inner join team as t on jp.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                where status='waiting'");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }   
        public function proposalApproved($idmember, $idteam){
            $stt = $this->mysqli->prepare("update join_proposal set status='approved' where idmember=? and idteam=?");
            $stt->bind_param('ii', $idmember, $idteam);
            $stt->execute();
        }
        public function proposalRejected($idmember, $idteam){
            $stt = $this->mysqli->prepare("update join_proposal set status='rejected' where idmember=? and idteam=?");
            $stt->bind_param('ii', $idmember, $idteam);
            $stt->execute();
        }
        public function addProposal($idmember, $idteam, $desc, $status){
            $stt = $this->mysqli->prepare("insert into join_proposal(idmember, idteam, description, status) values(?,?,?,?)");
            $stt->bind_param("iiss", $idmember, $idteam, $desc, $status);
            $stt->execute();
        }
        public function checkProposal($idmember, $idteam){
            $stt = $this->mysqli->prepare("select * from join_proposal where idmember = ? and idteam = ?");
            $stt->bind_param("ii", $idmember, $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
    }
?>