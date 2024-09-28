<?php 
    require_once("parent.php");
    class Event extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getEvent($cari=""){
            if(isset($cari)){
                $game = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select * from event where name LIKE ?");
                $stt->bind_param('s', $game); 
            }else {
                $stt = $this->mysqli->prepare("select * from event");
            }
            $stt-> execute();
        
            $result = $stt-> get_result();
            return $result;
        }
        public function getEventbyId($idevent){
            $stt = $this->mysqli->prepare("select * from event where idevent=?");
            $stt->bind_param("i", $idevent);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getEventTeam($idevent){
            $stt = $this->mysqli->prepare("select t.name as team_name from event e left join event_teams et on e.idevent = et.idevent left join team t on et.idteam = t.idteam where e.idevent = ?");
            $stt->bind_param("i", $idevent);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getEventTeambyId($idevent){
            $stt = $this->mysqli->prepare("select t.idteam, t.name as team_name, et.idevent from team as t
                                inner join event_teams as et on t.idteam = et.idteam where idevent=?");
            $stt->bind_param("i", $idevent);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function addEvent($name, $date, $desc){
            $stt = $this->mysqli->prepare("INSERT INTO event (name, date, description) VALUES (?, ?, ?);");
            $stt->bind_param('sss', $name, $date, $desc);
            $stt->execute();
            $last_id = $stt->insert_id;
            return $last_id;
        }
        public function addEventWithTeam($team, $last_id){
            foreach ($team as $idteam) {
                $statement = $this->mysqli->prepare("INSERT INTO event_teams (idevent, idteam) VALUES(?, ?)");
                $statement->bind_param('ii', $last_id, $idteam);
                $statement->execute();
            }
        }
        public function updateEvent($idevent, $name, $desc, $date) {
            $update_event = $this->mysqli->prepare("UPDATE event SET name = ?, description = ?, date = ? WHERE idevent = ?");
            $update_event->bind_param("sssi", $name, $desc, $date, $idevent);
            $update_event->execute();
        }
        public function getCurrentTeams($idevent) {
            $current_teams = [];
            $query_teams = $this->mysqli->prepare("SELECT idteam FROM event_teams WHERE idevent = ?");
            $query_teams->bind_param("i", $idevent);
            $query_teams->execute();
            $result = $query_teams->get_result();
            while ($row = $result->fetch_assoc()) {
                $current_teams[] = $row['idteam'];
            }
            return $current_teams;
        }
        public function addTeams($idevent, $new_teams, $current_teams) {
            foreach ($new_teams as $idteam) {
                if (!in_array($idteam, $current_teams)) {
                    $insert_team = $this->mysqli->prepare("INSERT INTO event_teams (idevent, idteam) VALUES (?, ?)");
                    $insert_team->bind_param("ii", $idevent, $idteam);
                    $insert_team->execute();
                }
            }
        }
        public function deleteTeams($idevent, $new_teams, $current_teams) {
            foreach ($current_teams as $idteam) {
                if (!in_array($idteam, $new_teams)) {
                    $delete_team = $this->mysqli->prepare("DELETE FROM event_teams WHERE idevent = ? AND idteam = ?");
                    $delete_team->bind_param("ii", $idevent, $idteam);
                    $delete_team->execute();
                }
            }
        }
        public function deleteEventTeams($idevent) {
            $stmt = $this->mysqli->prepare("DELETE FROM event_teams WHERE idevent = ?");
            $stmt->bind_param('i', $idevent);
            $stmt->execute();
        }
        public function deleteEvent($idevent) {
            $stmt2 = $this->mysqli->prepare("DELETE FROM event WHERE idevent = ?");
            $stmt2->bind_param('i', $idevent);
            $stmt2->execute();
        }
    }
?>