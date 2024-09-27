<?php 
    require_once("parent.php");
    class Achv extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getAchv($cari=""){
            if(isset($cari)){
                $acv= "%" . $cari . "%";
                $statement = $this->mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                            inner join team as t on a.idteam = t.idteam where a.name LIKE ?");
                $statement->bind_param('s', $acv); 
            }else {
                $statement = $this->mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                            inner join team as t on a.idteam = t.idteam");
            }
            $statement-> execute();
        
            $result = $statement-> get_result();
            return $result;
        }
        public function addAchv($idteam, $name, $date, $desc) {
            $stt = $this->mysqli->prepare("insert into achievement (idteam, name, date, description) values(?,?,?,?)");
            $stt->bind_param("isss", $idteam, $name, $date, $desc);
            $stt->execute();
        }
        public function getAchvbyId($idacv){
            $stt = $this->mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                    inner join team as t on a.idteam = t.idteam where a.idachievement = ?");
            $stt->bind_param("i", $idacv);
            $stt->execute();
            $result = $stt-> get_result();
            return $result;
        }
        public function editAcv($acv_name, $idteam, $date, $desc, $idacv){
            $stt = $this->mysqli->prepare("update achievement set name=?, idteam=?, date=?, description=? where idachievement=?");
            $stt->bind_param("sissi", $acv_name, $idteam, $date, $desc, $idacv);
            $stt->execute();
        }
        public function deleteAcv($idacv){
            $stt = $this->mysqli->prepare("delete from achievement where idachievement = ?");
            $stt->bind_param("i", $idacv);
            $stt->execute();
        }
    }

?>