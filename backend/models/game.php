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
    }
?>