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

    if(isset($_GET['idteam'])){
        $idteam = $_GET['idteam'];
    } else {
        header("location: ..\dbteam.php");
    }

    require_once("../models/team.php");
    require_once("../models/game.php");
    $team = new Team();
    $game = new Game();

    $result = $team->getTeambyId($idteam);
    while($row = $result->fetch_assoc()){
        $idgame = $row['idgame'];
        $team_name = $row['name'];
    }

    $result2 = $game->getGameTeambyId($idgame);
    $selectGame = [];
    while($row2 = $result2->fetch_assoc()){
        $selectGame[] = $row2['idgame'];
    }
    $allgame = $game->getGameTeam();

    $team_image_path = $team->getTeamImage($idteam);
    $default_image_path = "../../backendMember/icon/images/index.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>
    <h1>Edit Team</h1>

    <form action="editteam_proses.php" method="POST" enctype="multipart/form-data">
        <label for="name">Nama Team:</label>
        <input type="text" id="name" name="name" value="<?php echo $team_name; ?>"> <br><br>

        <label for="idgame">Game:</label>
        <select name="idgame" id="idgame">
            <?php 
                while($gameRow = $allgame->fetch_assoc()){
                    $selected = in_array($gameRow['idgame'], $selectGame) ? "selected" : "";
                    echo "<option value='" . $gameRow['idgame'] . "' $selected>" . $gameRow['name'] . "</option>";
                }
            ?>
        </select> <br><br>

        <?php if ($team_image_path && $team_image_path !== $default_image_path): ?>
            <label>Gambar Team Saat Ini:</label><br>
            <img id="currentImage" src="<?php echo $team_image_path . '?' . time(); ?>" alt="Gambar Tim" width="200px"> <br><br>
            <button type="button" onclick="deleteImage(<?php echo $idteam; ?>)">Hapus Gambar</button> <br><br>
        <?php else: ?>
            <img src="<?php echo $default_image_path; ?>" alt="Default Image" width="200px"> <br><br>
        <?php endif; ?>

        <label for="team_image">Upload Gambar Baru (JPG):</label>
        <input type="file" id="team_image" name="team_image" accept=".jpg"> <br><br>

        <label>Preview Gambar Baru:</label><br>
        <img id="imagePreview" src="" alt="Preview Gambar" width="200px" style="display: none;"> <br><br>

        <input type="submit" value="Submit Team" class="btn-add">
        <input type="hidden" value="<?php echo $idteam ;?>" name="idteam">
    </form>

    <script>
        const currentImage = document.getElementById('currentImage');
        const teamImageInput = document.getElementById('team_image');
        const imagePreview = document.getElementById('imagePreview');

        teamImageInput.addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        });

        function deleteImage(idteam) {
            if (confirm("Anda yakin ingin menghapus gambar ini?")) {
                window.location.href = 'delete_image.php?idteam=' + idteam;
            }
        }
    </script>
</body>
</html>
