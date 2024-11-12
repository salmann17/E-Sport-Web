<?php
require_once("../../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();

$idteam = $_GET['idteam'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 3; 
$offset = ($page - 1) * $limit;

$result = $teamMembers->displayAcvTeam($idteam, $limit, $offset);

$total_records = $teamMembers->countAchievements($idteam);
$total_pages = ceil($total_records / $limit);

$achievementHtml = '<strong class="judul">ACHIEVEMENT TEAM</strong>';

if ($result->num_rows > 0) {
    while ($achievement = $result->fetch_assoc()) {
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

$achievementHtml .= '<div class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    $achievementHtml .= "<a href='#' class='page-link' data-page='$i' data-idteam='$idteam'>$i</a>";
}
$achievementHtml .= '</div>';

echo $achievementHtml;
