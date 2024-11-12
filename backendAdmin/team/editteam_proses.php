<?php 
    require_once("../models/team.php");
    $team = new Team();

    $nama = $_POST['name'];
    $idgame = $_POST['idgame'];
    $idteam = $_POST['idteam'];

    $team_image = $_FILES['team_image'];

    $result = $team->editTeam($nama, $idgame, $idteam);

    $target_dir = "../../backendMember/icon/images/";
    $target_file = $target_dir . $idteam . ".jpg";

    if ($team_image['error'] === 0) {
        $imageFileType = strtolower(pathinfo($team_image['name'], PATHINFO_EXTENSION));

        if ($imageFileType != "jpg") {
            echo "File yang diunggah harus berformat JPG.";
            exit();
        }

        if (file_exists($target_file)) {
            unlink($target_file);
        }

        if (!move_uploaded_file($team_image['tmp_name'], $target_file)) {
            echo "Terjadi kesalahan saat mengunggah file.";
            exit();
        }
    }

    header("Location: ../dbteam.php");
    exit();
?>
