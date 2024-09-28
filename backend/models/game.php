<?php 
    require_once("parent.php");
    class Game extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getGameTeam(){
            $statement = $this->mysqli->prepare("select * from game");
            $statement-> execute();
            $result = $statement-> get_result();
            return $result;
        }
        public function getGameTeambyId($idgame){
            $statement = $this->mysqli->prepare("select * from game where idgame=?");
            $statement->bind_param("i", $idgame);
            $statement-> execute();
            $result = $statement-> get_result();
            return $result;
        }
        public function getGame($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $game = "%" . $cari . "%";
                $statement = $this->mysqli->prepare("select * from game where name LIKE ? LIMIT ? OFFSET ?");
                $statement->bind_param('sii', $game, $limit, $offset); 
            } else {
                $statement = $this->mysqli->prepare("select * from game LIMIT ? OFFSET ?");
                $statement->bind_param('ii', $limit, $offset);
            }
            $statement->execute();
            $result = $statement->get_result();
            return $result;
        }
        public function getTotalGames($cari = "") {
            if (!empty($cari)) {
                $game = "%" . $cari . "%";
                $statement = $this->mysqli->prepare("select count(*) as total from game WHERE name LIKE ?");
                $statement->bind_param('s', $game);
            } else {
                $statement = $this->mysqli->prepare("select count(*) as total from game");
            }
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        
        public function addGame($nama, $desc){
            $stt = $this->mysqli->prepare("insert into game (name, description) values(?,?)");
            $stt->bind_param("ss", $nama, $desc);
            $stt->execute();
        }
        public function editGame($nama, $desc, $idgame){
            $stt = $this->mysqli->prepare("update game set name=? , description=? where idgame=?");
            $stt->bind_param("ssi", $nama, $desc, $idgame);
            $stt->execute();
        }
        public function deleteGame($idgame){
            $stt = $this->mysqli->prepare("delete from game where idgame = ?");
            $stt->bind_param("i", $idgame);
            $stt->execute();
        }
    }
?>