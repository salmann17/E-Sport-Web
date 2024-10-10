<?php
    require_once("parent.php");
    class Team extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getAllTeam(){
            $statement = $this->mysqli->prepare("select * from team");
            $statement-> execute();
            $result = $statement-> get_result();
            return $result;
        }
        public function getTeam($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $team = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select idteam, t.name as team_name, g.name as game_name 
                                                from team as t
                                                inner join game as g on t.idgame = g.idgame 
                                                where t.name LIKE ? 
                                                LIMIT ? OFFSET ?");
                $stt->bind_param('sii', $team, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select idteam, t.name as team_name, g.name as game_name 
                                                from team as t
                                                inner join game as g on t.idgame = g.idgame 
                                                LIMIT ? OFFSET ?");
                $stt->bind_param('ii', $limit, $offset);
            }
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getTotalTeams($cari = "") {
            if (!empty($cari)) {
                $team = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select count(*) as total from team AS t WHERE t.name LIKE ?");
                $stt->bind_param('s', $team);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from team");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        public function getTeambyId($idteam){
            $stt = $this->mysqli->prepare("select * from team where idteam=?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function addTeam($nama, $idgame){
            $stt = $this->mysqli->prepare("insert into team (name, idgame) values(?,?)");
            $stt->bind_param("si", $nama, $idgame);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function editTeam($nama, $idgame, $idteam){
            $stt = $this->mysqli->prepare("update team set name=?, idgame=? where idteam=?");
            $stt->bind_param("sii", $nama, $idgame, $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function deleteTeam($idteam){
            $stt = $this->mysqli->prepare("delete from team where idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
        }
        public function getEventName($idteam){
            $stt = $this->mysqli->prepare("select e.name as event_name from event e left join event_teams et on e.idevent = et.idevent left join team t on et.idteam = t.idteam where t.idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getAchievName($idteam){
            $stt = $this->mysqli->prepare("select a.name as achiev_name from achievement a where a.idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
    }
?>