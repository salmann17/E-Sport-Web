<?php
    $idevent = $_POST['idevent']; 
    $name = $_POST['name']; 
    $desc = $_POST['desc']; 
    $date = $_POST['date'];
    $new_teams = [];
    if(isset($_POST['team'])){
        $new_teams = $_POST['team'];
    }

    $mysqli = new mysqli("localhost", "root", "", "esport");
        if($mysqli -> connect_errno){
            echo "failed to connect to mysql;" . $mysqli-> connect_error;
        }

    $update_event = $mysqli->prepare("UPDATE event SET name = ?, description = ?, date = ? WHERE idevent = ?");
    $update_event->bind_param("sssi", $name, $desc, $date, $idevent);
    $update_event->execute();

    $current_teams = [];
    $query_teams = $mysqli->prepare("SELECT idteam FROM event_teams WHERE idevent = ?");
    $query_teams->bind_param("i", $idevent);
    $query_teams->execute();
    $result = $query_teams->get_result();
    while ($row = $result->fetch_assoc()) {
        $current_teams[] = $row['idteam'];
    }

    foreach ($new_teams as $idteam) {
        if (!in_array($idteam, $current_teams)) {
            $insert_team = $mysqli->prepare("INSERT INTO event_teams (idevent, idteam) VALUES (?, ?)");
            $insert_team->bind_param("ii", $idevent, $idteam);
            $insert_team->execute();
        }
    }

    foreach ($current_teams as $idteam) {
        if (!in_array($idteam, $new_teams)) {
            $delete_team = $mysqli->prepare("DELETE FROM event_teams WHERE idevent = ? AND idteam = ?");
            $delete_team->bind_param("ii", $idevent, $idteam);
            $delete_team->execute();
        }
    }
    $mysqli->close();
    header("Location: ../dbevent.php");
    exit();
?>