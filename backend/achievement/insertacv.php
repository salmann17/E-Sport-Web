<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Achievement</title>
    <link rel="stylesheet" href="../css/insert.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>
<body>

    <h1>Insert Achievement</h1>

    <form action="insertacv_proses.php" method="POST">
        <label for="name">Nama Achievement:</label>
        <input type="text" id="name" name="name" required> <br><br>
        <label for="name">Nama Team:</label>
        <select name="idteam" id="idteam">
            <?php 
                require_once("../models/team.php");
                $team = new Team();
                $result = $team->getAllTeam();
                while($row = $result->fetch_assoc()){
                    echo "<option value='".$row['idteam']."'>".$row['name']."</option>";

                }
            ?>
        </select> <br><br>
        <label for="date">Date: </label>
        <input type="date" name="date" id="date"><br><br>
        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ></textarea> <br> <br>
        <input type="submit" value="Submit Achievement" class="btn-add">
    </form>
</body>
</html>
