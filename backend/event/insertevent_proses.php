<?php
$mysqli = new mysqli("localhost", "root", "", "esport");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$name = $_POST['name'];
$date = $_POST['date'];
$desc = $_POST['desc'];

$stmt = $mysqli->prepare("INSERT INTO event (name, date, description) VALUES (?, ?, ?);");
$stmt->bind_param('sss', $name, $date, $desc);
$stmt->execute();
$last_id = $stmt->insert_id;

$jumlah_yang_dieksekusi;

if(isset($_POST['team']))
{
    $team = $_POST['team'];
    foreach ($team as $idteam) {
    $statement = $mysqli->prepare("INSERT INTO event_teams (idevent, idteam) VALUES(?, ?)");
    $statement->bind_param('ii', $last_id, $idteam);
    $statement->execute();
    $statement->close();
}
}
$mysqli->close();
header("Location: ../dbevent.php");
exit();
?>