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
        public function displayAllTeam($idmember, $limit, $offset) {
            $stt = $this->mysqli->prepare("select m.username, tm.idteam, t.name AS team_name, t.idgame, g.name AS game_name,
                                            g.description AS game_desc FROM team_members AS tm
                                            inner join member AS m ON tm.idmember = m.idmember
                                            inner join team AS t ON tm.idteam = t.idteam
                                            inner join game AS g ON t.idgame = g.idgame
                                            where tm.idmember = ?
                                            limit ? offset ?;");
            $stt->bind_param("iii", $idmember, $limit, $offset);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function countAllTeam($idmember) {
            $stt = $this->mysqli->prepare("select count(*) as total from team_members as tm
                                            inner join member as m on tm.idmember = m.idmember
                                            inner join team as t on tm.idteam = t.idteam
                                            inner join game as g on t.idgame = g.idgame
                                            where tm.idmember = ?;");
            $stt->bind_param("i", $idmember);
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
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
        public function displayAcvTeam($idteam, $limit, $offset){
            $stt = $this->mysqli->prepare("select acv.name as acv_name, acv.date as acv_date, acv.description as acv_desc
                                            from achievement as acv
                                            inner join team as t on t.idteam = acv.idteam
                                            where t.idteam = ? LIMIT ? OFFSET ?;");
            $stt->bind_param("iii", $idteam, $limit, $offset);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function displayEventTeam($idteam, $limit, $offset){
            $stt = $this->mysqli->prepare("select e.name as event_name, e.date as event_date, e.description as event_desc from
                                            event_teams as et
                                            inner join event as e on et.idevent = e.idevent
                                            where et.idteam = ? LIMIT ? OFFSET ?;");
            $stt->bind_param("iii", $idteam, $limit, $offset);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function countAchievements($idteam) {
            $stt = $this->mysqli->prepare("select count(*) as count from achievement where idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result->fetch_assoc()['count'];
        }
        public function countEvents($idteam) {
            $stt = $this->mysqli->prepare("select count(*) as count from event_teams where idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result->fetch_assoc()['count'];
        }
                
    }
?>