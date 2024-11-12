<?php
require_once("../../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();

$idteam = $_GET['idteam'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 3; 
$offset = ($page - 1) * $limit;

$result = $teamMembers->displayEventTeam($idteam, $limit, $offset);

$total_records = $teamMembers->countEvents($idteam);
$total_pages = ceil($total_records / $limit);

$eventHtml = '<strong class="judul">EVENT TEAM</strong>';

if ($result->num_rows > 0) {
    while ($event = $result->fetch_assoc()) {
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
    $eventHtml .= '<div class="event-card"><div class="event-details"><p>Team has not followed any events.</p></div></div>';
}

$eventHtml .= '<div class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    $eventHtml .= "<a href='#' class='page-link' data-page='$i' data-idteam='$idteam'>$i</a>";
}
$eventHtml .= '</div>';

echo $eventHtml;
