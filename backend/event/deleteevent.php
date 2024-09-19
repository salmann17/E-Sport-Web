<?php
    $idevent = $_GET['idevent'];
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }
    $stmt = $mysqli->prepare("DELETE FROM event_teams WHERE (idevent = ?);");
    $stmt->bind_param('i', $idevent);
    $stmt->execute();
    $stmt->close();

    $stmt2 = $mysqli->prepare("DELETE FROM event WHERE (idevent = ?);");
    $stmt2->bind_param('i', $idevent);
    $stmt2->execute();
    $stmt2->close();
    
    $mysqli->close();
    header("Location: ../dbevent.php");
    exit();
    ?>