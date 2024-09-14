<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $nama = $_POST['name'];
    $idgame = $_POST['idgames'];
    $stt = $mysqli->prepare("insert into team (name, idgame) values(?,?)");
    $stt->bind_param("si", $nama, $idgame);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: dbteam.php");
    exit();
?>