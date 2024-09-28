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
        public function getTeam($cari=""){
            if(isset($cari)){
                $team = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select idteam, t.name as team_name, g.name as game_name from team as t
                            inner join game as g on t.idgame = g.idgame where t.name LIKE ?");
                $stt->bind_param('s', $team); 
            }else {
                $stt = $this->mysqli->prepare("select idteam, t.name as team_name, g.name as game_name from team as t
                            inner join game as g on t.idgame = g.idgame");
            }
            $stt-> execute();
        
            $result = $stt-> get_result();
            return $result;
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
    }
?>