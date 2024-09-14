<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Game</title>
    <link rel="stylesheet" href="../css/insert.css">
</head>
<body>

    <h1>Insert Game</h1>

    <form action="insertgame_proses.php" method="POST">
        <label for="name">Nama Game:</label>
        <input type="text" id="name" name="name" required> <br><br>

        <label for="name">Deskripsi:</label>
        <textarea id="desc" name="desc" rows="4" cols="50" ></textarea> <br> <br>

        <input type="submit" value="Submit Game" class="btn-add">
    </form>

</body>
</html>

