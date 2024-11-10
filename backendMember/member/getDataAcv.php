<?php
require_once("../../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();
$idteam = $_GET['idteam'];

$result3 = $teamMembers->displayAcvTeam($idteam);
$achievementHtml = '<strong class="judul">ACHIEVEMENT TEAM</strong>';

if ($result3->num_rows > 0) {
    while ($achievement = $result3->fetch_assoc()) {
        $achievementHtml .= '
            <div class="event-card">
                <div class="event-details">
                    <strong>' . htmlspecialchars($achievement['acv_name']) . '</strong>
                    <p>' . htmlspecialchars($achievement['acv_date']) . '</p>
                    <p class="white">' . htmlspecialchars($achievement['acv_desc']) . '</p>
                </div>
            </div>
        ';
    }
} else {
    $achievementHtml .= '<div class="event-card"><div class="event-details"><p>Team has not Achievement.</p></div></div>';
}

echo $achievementHtml;
?>
