<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }

    $idteam = $_POST['idteam'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];

    $stt = $mysqli->prepare("insert into achievement (idteam, name, date, description) values(?,?,?,?)");
    $stt->bind_param("isss", $idteam, $name, $date, $desc);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: ../dbachievement.php");
    exit();
?>