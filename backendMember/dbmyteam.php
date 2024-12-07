<?php
session_start();

if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
	$path = $_SERVER['SCRIPT_NAME'];
	$queryString = $_SERVER['QUERY_STRING'];
	$url = "http://" . $domain . $path . "?" . $queryString;

	header("location: member/dblogin.php?url_asal=".$url);
    exit();
}

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: ../DashboardAdmin.php");
    exit();
}
$idmember = $_SESSION['userid'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 1;
$offset = ($page - 1) * $limit;

require_once("../backendAdmin/models/teammembers.php");
$teamMembers = new TeamMembers();
$result = $teamMembers->displayAllTeam($idmember, $limit, $offset);

$total_records = $teamMembers->countAllTeam($idmember);
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Team</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dbmember.css">
    <link rel="stylesheet" href="css/cardteam.css">
    <link rel="stylesheet" href="css/jquery.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
    <script src="../backendAdmin/jquery-3.5.1.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="icon/logo.png" alt="esport-logo">
        </div>
        <ul class="nav-links">
            <li><a href="../DashboardMember.php">Home</a></li>
            <li><a href="dbjointeam.php?idmember=<?php echo $idmember; ?>">Join Team</a></li>
            <li><a href="dbmyteam.php?idmember=<?php echo $idmember; ?>">My Team</a></li>
            <li><a href="member/dblogout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="background-wrapper">
        <div class="container">
            <div class="card-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $idteam = $row['idteam'];
                        $teamName = $row['team_name'];
                        $gameName = $row['game_name'];
                        $gameDesc = $row['game_desc'];
                
                        if(!empty($idteam)){
                            echo '<div class="card">';
                            echo '<div class="card-image"> ';
                            $image = 'icon/images/' . $idteam . '.jpg';
                            if(file_exists($image)){
                                echo '<img src="'.$image.'" class="card-image"> </div>';
                            } else{
                                echo '<img src="icon/images/index.png" class="card-image"> </div>';
                            }
                            echo '<h3 class="team-name">'.$teamName.'</h3>';
                            echo '<p class="game-name">Team ini termasuk ke dalam divisi game '.$gameName.'. '.$gameDesc.'</p>';
                            echo '<br>';
                            echo '<b>TEAM MEMBERS</b>';
                
                            echo '<ul class="card-list">';
                            $result2 = $teamMembers->displayAllMembers($idteam);
                            while($row2 = $result2->fetch_assoc()) {
                                $username = $row2['username'];
                                echo '<li>'.$username.'</li>';
                            }
                            echo '</ul>';
                
                            echo '<div class="card-links">';
                            echo '<a href="dbmyteam.php?idmember='.$idmember.'&idteam='. $idteam .'" class="card-link" id="acv" >Achievement</a>';
                            echo '<a href="dbmyteam.php?idmember='.$idmember.'&idteam='. $idteam .'" class="card-link" id="evnt" >Event</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<div class="card">';
                    echo '<div class="card-image"> ';
                    echo '<img src="icon/images/0.png" class="card-image"> </div>';
                    echo '<a class="btn-jointeam" href="dbjointeam.php?idmember='.$idmember.'">Join Team</a>';
                    echo '</div>';
                }
                ?>
                
            </div>
            <input type="hidden" name="">
            <div class="pagination">
                <?php
                if ($page > 1) {
                    $prev_page = $page - 1;
                    echo "<a href='dbmyteam.php?page=$prev_page&idmember=$idmember'>Previous</a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = $i == $page ? 'active' : '';
                    echo "<a href='dbmyteam.php?page=$i&idmember=$idmember' class='$active_class'>$i</a>";
                }

                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo "<a href='dbmyteam.php?page=$next_page&idmember=$idmember'>Next</a>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container-ajax">
        <div id="event-list" class="event-list"></div>
        <div id="achievement-list" class="achievement-list"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#acv', function(event) {
                event.preventDefault();
                const url = new URL($(this).attr('href'), window.location.origin);
                const idteam = url.searchParams.get('idteam');
                $('#event-list').empty();
                loadAchievement(idteam, 1); 
            });

            $('body').on('click', '#evnt', function(event) {
                event.preventDefault();
                const url = new URL($(this).attr('href'), window.location.origin);
                const idteam = url.searchParams.get('idteam');
                $('#achievement-list').empty();
                loadEvent(idteam, 1); 
            });

            $('body').on('click', '.page-link', function(event) {
                event.preventDefault();
                const page = $(this).data('page');
                const idteam = $(this).data('idteam');
                if ($(this).closest('#event-list').length > 0) {
                    loadEvent(idteam, page); 
                } else {
                    loadAchievement(idteam, page); 
                }
            });

            function loadAchievement(idteam, page) {
                $.ajax({
                    url: 'member/getDataAcv.php',
                    type: 'GET',
                    data: { idteam: idteam, page: page },
                    success: function(response) {
                        $('#achievement-list').html(response); 
                    },
                    error: function() {
                        alert('Gagal mengambil data achievement.');
                    }
                });
            }

            function loadEvent(idteam, page) {
                $.ajax({
                    url: 'member/getDataEvent.php',
                    type: 'GET',
                    data: { idteam: idteam, page: page },
                    success: function(response) {
                        $('#event-list').html(response); 
                    },
                    error: function() {
                        alert('Gagal mengambil data event.');
                    }
                });
            }
        });
    </script>
</body>

</html>