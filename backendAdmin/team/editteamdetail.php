<?php
if (isset($_GET['idteam'])) {
    $idteam = $_GET['idteam'];
}
require_once("../models/team.php");
require_once("../models/achievement.php");
require_once("../models/event.php");
$team = new Team();
$achievement = new Achv();
$event = new Event();


$result = $team->getTeambyId($idteam);
while ($row = $result->fetch_assoc()) {
    $idgame = $row['idgame'];
    $team_name = $row['name'];
}

$res = $event->getTeamEventbyId($idteam);
$selectEvent = [];
while ($row2 = $res->fetch_assoc()) {
    $selectEvent[] = $row2['idevent'];
}
$allevent = $event->getAllEvent();

$res2 = $achievement->getAchvbyTeamId($idteam);
$selectAchv = [];
while ($row3 = $res2->fetch_assoc()) {
    $selectAchv[] = $row3['idachievement'];
}
$curachv = $achievement->getCurAcv($idteam);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Detail</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
    <script src="../jquery-3.5.1.min.js"></script>
</head>

<body>
    <h1>Team Detail</h1>

    <form action="editteamdetail_proses.php" method="POST">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" value="<?php echo $team_name; ?>" disabled> <br><br>

        <label for="">Achievement :</label> <br>
        <?php
        while($achvrow = $curachv->fetch_assoc()) {
            echo "<input type='checkbox' name='achv[]' value='" . $achvrow['idachievement'] . "' checked> " . $achvrow['name'];
            echo " | <a href='../achievement/editacv.php?idacv=" . $achvrow['idachievement'] . "&source=editdetailteam'>Ubah</a><br>";
        }
        ?> <br><br>

        <div id="achievementsContainer">

        </div>

        <input type="button" id="btnTambahAchv" class="btn-add" value="Tambah Achievement"> <br> <br>

        <label for="">Event Yang Diikuti :</label> <br>
        <?php
        while ($eventrow = $allevent->fetch_assoc()) {
            $checked = in_array($eventrow['idevent'], $selectEvent) ? "checked" : "";
            echo "<input type='checkbox' name='event[]' value='" . $eventrow['idevent'] . "' $checked> " . $eventrow['name'] . "<br>";
        }
        ?> <br><br>
        <input type="submit" value="Submit Team Detail" class="btn-add">
        <input type="hidden" value="<?php echo $idteam; ?>" name="idteam">
    </form>

    <script type="text/javascript">
        var count = 1;

        $('#btnTambahAchv').click(function () {
            var newAchievementHtml = `
                <div class="achievement">
                    <label for="name">Nama Achievement ${count}:</label>
                    <input type="text" name="nameachv[]" required> <br><br>
                    <label for="date">Date ${count}: </label>
                    <input type="date" name="dateachv[]" required><br><br>
                    <label for="desc">Deskripsi ${count}:</label>
                    <textarea name="descachv[]" rows="4" cols="50" required></textarea> <br><br>
                    <button type="button" class="add-button btnHapusAchv">Hapus</button>
                </div>
            `;
            $('#achievementsContainer').append(newAchievementHtml);
            count++;
        });

        $('#achievementsContainer').on('click', '.btnHapusAchv', function () {
            $(this).closest('.achievement').remove();
            count--;
        });
    </script>
</body>

</html>