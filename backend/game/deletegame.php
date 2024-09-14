<?php 
    if(isset($_GET['idgame'])){
        $idgame = $_GET['idgame'];
    }
    $mysqli = new mysqli("localhost","root","","esport");
    if($mysqli->connect_errno){
        echo "failed to connect to mysql;" . $mysqli-> connect_error;
    }

    $stt = $mysqli->prepare("delete from game where idgame = ?");
    $stt->bind_param("i", $idgame);
    $stt->execute();
    if ($stt->affected_rows > 0) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data atau data tidak ditemukan.";
    }
    $result = $stt-> get_result();
    $stt->close();
    $mysqli->close();
    header("location: ../dbgame.php");
?>