<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }
    $idgame = $_POST['idgame'];
    $nama = $_POST['name'];
    $desc = $_POST['desc'];
    
    $stt = $mysqli->prepare("update game set name=? , description=? where idgame=?");
    $stt->bind_param("ssi", $nama, $desc, $idgame);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: ../dbgame.php");
    exit();
?>