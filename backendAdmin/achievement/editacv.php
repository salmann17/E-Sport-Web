<?php
session_start();
    
if (!isset($_SESSION['userid'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("location: ..\..\backendMember\member\dblogin.php?url_asal=".$url);
    exit();
}

$isFromEditDetailTeam = isset($_GET['source']) && $_GET['source'] === 'editdetailteam';
if (isset($_GET['source'])) {
    $source = $_GET['source'];
    
}
if(isset($_GET['idacv'])){
    $idacv = $_GET['idacv'];
    
}
else{
    header("location: ..\dbachievement.php");
}
require_once("../models/achievement.php");
$acv = new Achv();

$result = $acv->getAchvbyId($idacv);
$selectTeam = [];
while ($row = $result->fetch_assoc()) {
    $idteam = $row['idteam'];
    $acv_name = $row['acv_name'];
    $team_name = $row['team_name'];
    $date = $row['date'];
    $desc = $row['description'];
    $selectTeam[] = $row['idteam'];
}

require_once("../models/team.php");
$team = new Team();
$allteam = $team->getAllTeam();
$curteam = $acv->getAchvbyId($idacv);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>

<body>
    <h1>Edit Achievement</h1>

    <form action="editacv_proses.php" method="POST">
        <label for="name">Nama Achievement:</label>
        <input type="text" id="name" name="name" value="<?php echo $acv_name ?>"> <br><br>
        <label for="name">Nama Team:</label>
        <select name="idteam" id="idteam">
            <?php
            if(isset($_GET['source']) && $_GET['source'] === 'editdetailteam'){
                while ($teamRow = $curteam->fetch_assoc()) {
                    $selected = in_array($teamRow['idteam'], $selectTeam) ? "selected" : "";
                    echo "<option value='" . $teamRow['idteam'] . "' $selected>" . $teamRow['team_name'] . "</option>";
                }
            }
            else{
                while ($teamRow = $allteam->fetch_assoc()) {
                    $selected = in_array($teamRow['idteam'], $selectTeam) ? "selected" : "";
                    echo "<option value='" . $teamRow['idteam'] . "' $selected>" . $teamRow['name'] . "</option>";
                }
            }
            
            ?>
        </select> <br><br>
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" value="<?php echo $date; ?>"><br><br>
        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50"><?php echo $desc; ?></textarea> <br> <br>
        <input type="submit" value="Submit Achievement" class="btn-add">
        <input type="hidden" value="<?php echo $idacv; ?>" name="idacv">
        <?php
        if(isset($_GET['source']) && $_GET['source'] === 'editdetailteam'){
            echo "<input type='hidden' value= $source name='source'>";
        }
        ?>
        <input type="hidden" value="<?php echo $idacv; ?>" name="idacv">
    </form>
</body>

</html>