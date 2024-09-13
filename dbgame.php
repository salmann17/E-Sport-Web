<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1b1b1b;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #00d4ff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #00d4ff;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2a2a2a;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #2a2a2a;
        }
        tr:hover {
            background-color: #00d4ff;
            color: #000;
        }
        .btn-add {
            background-color: #00d4ff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-add:hover {
            background-color: #008cbf;
        }
    </style>
</head>
<body>

    <h1>Game Management</h1>
    <a href="addgame.php" class="btn-add">Tambah Game Baru</a>

    <table>
        <tr>
            <th>Nama Game</th>
            <th>Genre</th>
            <th>Tanggal Rilis</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>Valorant</td>
            <td>FPS</td>
            <td>2020-06-02</td>
            <td><a href="#">Ubah</a> | <a href="#">Hapus</a></td>
        </tr>
        <tr>
            <td>DOTA 2</td>
            <td>MOBA</td>
            <td>2013-07-09</td>
            <td><a href="#">Ubah</a> | <a href="#">Hapus</a></td>
        </tr>
    </table>

</body>
</html>
