<?php
$url_asal = isset($_GET['url_asal']) ? $_GET['url_asal'] : "dblogin.php";

if (isset($_SESSION['userid'])) {
    header("location: " . $url_asal);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <div class="form-container">
        <h1>Login</h1>
        <form action="login_proses.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="dbregister.php" class="btn-register">Don't have an account? Register</a>
    </div>

</body>

</html>