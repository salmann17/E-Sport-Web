<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $nama = $_POST['name'];
    $desc = $_POST['desc'];
    $stt = $mysqli->prepare("insert into game (name, description) values(?,?)");
    $stt->bind_param("ss", $nama, $desc);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: ../dbgame.php");
    exit();
?>