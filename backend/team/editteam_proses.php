<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }
    $nama = $_POST['name'];
    $idgame = $_POST['idgame'];
    $idteam = $_POST['idteam'];

    $stt = $mysqli->prepare("update team set name=?, idgame=? where idteam=?");
    $stt->bind_param("sii", $nama, $idgame, $idteam);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: ../dbteam.php");
    exit();
?>