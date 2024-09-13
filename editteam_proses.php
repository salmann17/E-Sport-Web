<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $nama = $_POST['name'];
    $idgame = $_POST['idgames'];
    $idteam = $_POST['idteam'];
    $stt = $mysqli->prepare("update team set name=?, idgame=? where idteam=?");
    $stt->bind_param("sii", $nama, $idgame, $idteam);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("location : dbteam.php");
    exit();
?>