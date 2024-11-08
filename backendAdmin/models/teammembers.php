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
        public function getTeamMembers($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $teamMembers = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select tm.idteam, tm.idmember, t.idgame ,t.name as teamname, g.name as gamename, m.username from team_members as tm
                                                inner join member as m on tm.idmember = m.idmember
                                                inner join team as t on tm.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                where t.name LIKE ? LIMIT ? OFFSET ?;");
                $stt->bind_param('sii', $teamMembers, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select tm.idteam, tm.idmember, t.name as teamname, g.name as gamename, m.username from team_members as tm
                                                inner join member as m on tm.idmember = m.idmember
                                                inner join team as t on tm.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                LIMIT ? OFFSET ?;");
                $stt->bind_param('ii', $limit, $offset);
            }
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getTotalTeamMembers($cari = "") {
            if (!empty($cari)) {
                $teamMembers = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select count(*) as total from team_members as tm
                                                inner join member as m on tm.idmember = m.idmember
                                                inner join team as t on tm.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame
                                                where t.name LIKE ?");
                $stt->bind_param('s', $teamMembers);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from team_members as tm
                                                inner join member as m on tm.idmember = m.idmember
                                                inner join team as t on tm.idteam = t.idteam
                                                inner join game as g on t.idgame = g.idgame");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }   
        public function displayAllTeam($idmember){
            $stt = $this->mysqli->prepare("select m.username, tm.idteam, t.name as team_name, t.idgame, g.name as game_name,
                                            g.description as game_desc from team_members as tm
                                            inner join member as m on tm.idmember = m.idmember
                                            inner join team as t on tm.idteam = t.idteam
                                            inner join game as g on t.idgame = g.idgame
                                            where tm.idmember  = ? ;");
            $stt->bind_param("i", $idmember);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function displayAllMembers($idteam){
            $stt = $this->mysqli->prepare("select distinct m.username from join_proposal as jp
                                            inner join member as m on jp.idmember = m.idmember
                                            where jp.idteam = ? and jp.status = 'approved';");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
    }
?>