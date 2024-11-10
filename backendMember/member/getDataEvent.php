<?php
require_once("../../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();
$idteam = $_GET['idteam'];

$result3 = $teamMembers->displayEventTeam($idteam);
$eventHtml = '<strong class="judul">EVENT TEAM</strong>';

if ($result3->num_rows > 0) {
    while ($event = $result3->fetch_assoc()) {
        $eventHtml .= '
            <div class="event-card">
                <div class="event-details">
                    <strong>' . htmlspecialchars($event['event_name']) . '</strong>
                    <p>' . htmlspecialchars($event['event_date']) . '</p>
                    <p class="white">' . htmlspecialchars($event['event_desc']) . '</p>
                </div>
            </div>
        ';
    }
} else {
    $eventHtml .= '
        <div class="event-card">
            <div class="event-details">
                <p>Team has not followed any events.</p>
            </div>
        </div>
    ';
}

echo $eventHtml;
?>
