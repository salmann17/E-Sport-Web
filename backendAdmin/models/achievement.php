<?php 
    require_once("parent.php");
    class Achv extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getAchv($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $acv = "%" . $cari . "%";
                $statement = $this->mysqli->prepare("select a.idachievement, a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description 
                                                     from achievement as a
                                                     inner join team as t on a.idteam = t.idteam 
                                                     where a.name LIKE ? 
                                                     LIMIT ? OFFSET ?");
                $statement->bind_param('sii', $acv, $limit, $offset); 
            } else {
                $statement = $this->mysqli->prepare("select a.idachievement, a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description 
                                                     from achievement as a
                                                     inner join team as t on a.idteam = t.idteam 
                                                     LIMIT ? OFFSET ?");
                $statement->bind_param('ii', $limit, $offset); 
            }
            $statement->execute();
            $result = $statement->get_result();
            return $result;
        }
        
        // Fungsi untuk mendapatkan total data
        public function getTotalAchv($cari = "") {
            if (!empty($cari)) {
                $acv = "%" . $cari . "%";
                $statement = $this->mysqli->prepare("select count(*) as total from achievement as a 
                                                     inner join team AS t ON a.idteam = t.idteam 
                                                     WHERE a.name LIKE ?");
                $statement->bind_param('s', $acv);
            } else {
                $statement = $this->mysqli->prepare("select count(*) as total from achievement as a 
                                                     inner join team as t on a.idteam = t.idteam");
            }
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
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
        public function deleteAllAcv($idteam){
            $stt = $this->mysqli->prepare("delete from achievement where idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
        }
        public function deleteAchievementbyTeam($idteam, $new_achv, $current_achv) {
            foreach ($current_achv as $idachievement) {
                if (!in_array($idachievement, $new_achv)) {
                    $delete_achv = $this->mysqli->prepare("delete from achievement WHERE idteam = ? and idachievement=?");
                    $delete_achv->bind_param("ii", $idteam, $idachievement);
                    $delete_achv->execute();
                }
            }
        }
        public function getAllAcv(){
            $stt = $this->mysqli->prepare("select * from achievement");
            $stt-> execute();
            $result = $stt-> get_result();
            return $result;
        }
        public function getCurAcv($idteam){
            $stt = $this->mysqli->prepare("select * from achievement where idteam=?");
            $stt->bind_param("i",$idteam);
            $stt-> execute();
            $result = $stt-> get_result();
            return $result;
        }
        public function getAchvbyTeamId($idteam){
            $stt = $this->mysqli->prepare("select a.idachievement ,a.idteam, a.name as acv_name, t.name as team_name, a.date, a.description from achievement as a
                    inner join team as t on a.idteam = t.idteam where a.idteam = ?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt-> get_result();
            return $result;
        }
    }

?>