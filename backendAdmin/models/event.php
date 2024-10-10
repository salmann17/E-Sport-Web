<?php 
    require_once("parent.php");
    class Event extends ParentClass{
        public function __construct()
        {
            parent:: __construct();
        }
        public function getEvent($cari = "", $limit = 5, $offset = 0) {
            if (!empty($cari)) {
                $event = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select * from event where name LIKE ? LIMIT ? OFFSET ?");
                $stt->bind_param('sii', $event, $limit, $offset);
            } else {
                $stt = $this->mysqli->prepare("select * from event LIMIT ? OFFSET ?");
                $stt->bind_param('ii', $limit, $offset);
            }
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function getTotalEvents($cari = "") {
            if (!empty($cari)) {
                $event = "%" . $cari . "%";
                $stt = $this->mysqli->prepare("select count(*) as total from event where name LIKE ?");
                $stt->bind_param('s', $event);
            } else {
                $stt = $this->mysqli->prepare("select count(*) as total from event");
            }
            $stt->execute();
            $result = $stt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
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
        public function getTeamEventbyId($idteam){
            $stt = $this->mysqli->prepare("select e.idevent, e.name as event_name, et.idevent from event as e
                                inner join event_teams as et on e.idevent = et.idevent where et.idteam=?");
            $stt->bind_param("i", $idteam);
            $stt->execute();
            $result = $stt->get_result();
            return $result;
        }
        public function addEvent($name, $date, $desc){
            $stt = $this->mysqli->prepare("insert into event (name, date, description) values (?, ?, ?);");
            $stt->bind_param('sss', $name, $date, $desc);
            $stt->execute();
            $last_id = $stt->insert_id;
            return $last_id;
        }
        public function addEventWithTeam($team, $last_id){
            foreach ($team as $idteam) {
                $statement = $this->mysqli->prepare("insert into event_teams (idevent, idteam) values(?, ?)");
                $statement->bind_param('ii', $last_id, $idteam);
                $statement->execute();
            }
        }
        public function addTeamWithEvent($event, $last_id){
            foreach ($event as $idevent) {
                $statement = $this->mysqli->prepare("insert into event_teams (idevent, idteam) values(?, ?)");
                $statement->bind_param('ii', $idevent, $last_id);
                $statement->execute();
            }
        }
        public function updateEvent($idevent, $name, $desc, $date) {
            $update_event = $this->mysqli->prepare("update event set name = ?, description = ?, date = ? WHERE idevent = ?");
            $update_event->bind_param("sssi", $name, $desc, $date, $idevent);
            $update_event->execute();
        }
        public function getCurrentTeams($idevent) {
            $current_teams = [];
            $query_teams = $this->mysqli->prepare("select idteam from event_teams WHERE idevent = ?");
            $query_teams->bind_param("i", $idevent);
            $query_teams->execute();
            $result = $query_teams->get_result();
            while ($row = $result->fetch_assoc()) {
                $current_teams[] = $row['idteam'];
            }
            return $current_teams;
        }
        public function getCurrentEvent($idteam) {
            $current_event = [];
            $query_event = $this->mysqli->prepare("select idevent from event_teams WHERE idteam = ?");
            $query_event->bind_param("i", $idteam);
            $query_event->execute();
            $result = $query_event->get_result();
            while ($row = $result->fetch_assoc()) {
                $current_event[] = $row['idevent'];
            }
            return $current_event;
        }
        public function addTeams($idevent, $new_teams, $current_teams) {
            foreach ($new_teams as $idteam) {
                if (!in_array($idteam, $current_teams)) {
                    $insert_team = $this->mysqli->prepare("insert into event_teams (idevent, idteam) values (?, ?)");
                    $insert_team->bind_param("ii", $idevent, $idteam);
                    $insert_team->execute();
                }
            }
        }
        public function deleteTeams($idevent, $new_teams, $current_teams) {
            foreach ($current_teams as $idteam) {
                if (!in_array($idteam, $new_teams)) {
                    $delete_team = $this->mysqli->prepare("delete from event_teams WHERE idevent = ? AND idteam = ?");
                    $delete_team->bind_param("ii", $idevent, $idteam);
                    $delete_team->execute();
                }
            }
        }
        public function addEvents($idteam, $new_event, $current_event) {
            foreach ($new_event as $idevent) {
                if (!in_array($idevent, $current_event)) {
                    $insert_team = $this->mysqli->prepare("insert into event_teams (idevent, idteam) values (?, ?)");
                    $insert_team->bind_param("ii", $idevent, $idteam);
                    $insert_team->execute();
                }
            }
        }
        public function deleteEvents($idteam, $new_event, $current_event) {
            foreach ($current_event as $idevent) {
                if (!in_array($idevent, $new_event)) {
                    $delete_team = $this->mysqli->prepare("delete from event_teams WHERE idevent = ? AND idteam = ?");
                    $delete_team->bind_param("ii", $idevent, $idteam);
                    $delete_team->execute();
                }
            }
        }
        public function deleteEventTeams($idevent) {
            $stmt = $this->mysqli->prepare("delete from event_teams WHERE idevent = ?");
            $stmt->bind_param('i', $idevent);
            $stmt->execute();
        }
        public function deleteEvent($idevent) {
            $stmt2 = $this->mysqli->prepare("delete from event WHERE idevent = ?");
            $stmt2->bind_param('i', $idevent);
            $stmt2->execute();
        }
        public function getAllEvent(){
            $stt = $this->mysqli->prepare("select * from event");
            $stt-> execute();
            $result = $stt-> get_result();
            return $result;
        }
    }
?>