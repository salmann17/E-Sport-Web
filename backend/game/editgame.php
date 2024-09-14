<?php 
    if(isset($_GET['idgame'])){
        $idgame = $_GET['idgame'];
    }
    $mysqli = new mysqli("localhost", "root", "", "esport");
    if($mysqli -> connect_errno){
        echo "Failed to connect to MySQL: " . $mysqli-> connect_error;
    }
    $stt = $mysqli->prepare("select * from game where idgame=?");
    $stt->bind_param("i", $idgame);
    $stt->execute();
    $result = $stt->get_result();
    while($row = $result->fetch_assoc()){
        $name= $row['name'];
        $desc = $row['description'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>

    <h1>Edit Game</h1>

    <form action="editgame_proses.php" method="POST">
        <label for="name">Nama Game:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"> <br><br>

        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ><?php echo $desc; ?></textarea> <br> <br>
        <input type="submit" value="Submit Game" class="btn-add">
        <input type="hidden" value="<?php echo $idgame ;?>" name="idgame">
    </form>
</body>
</html>
<?php
    $stt->close();
    $mysqli->close();
?>

