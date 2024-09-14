<?php 
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }
    $idacv = $_POST['idacv'];
    $acv_name = $_POST['name'];
    $idteam = $_POST['idteam'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];

    $stt = $mysqli->prepare("update achievement set name=?, idteam=?, date=?, description=? where idachievement=?");
    $stt->bind_param("sissi", $acv_name, $idteam, $date, $desc, $idacv);
    $stt->execute();
    $stt->close();


    $mysqli->close();
    header("Location: ../dbachievement.php");
    exit();
?>