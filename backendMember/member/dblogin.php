<?php  
session_start();

$url_asal = isset($_GET['url_asal']) ? $_GET['url_asal'] : '';

if (isset($_SESSION['userid'])) {
    if ($_SESSION['role'] == 'admin') {
        $url_asal = "../../DashboardAdmin.php";
    } else {
        $url_asal = "../../DashboardMember.php";
    }
    header("location: " . $url_asal);
    exit();
}

$error_message = '';
if (isset($_GET['error']) && $_GET['error'] == '1') {
    $error_message = "Username atau password salah. Silakan coba lagi.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../icon/logo.png" type="image/png">
</head>

<body>

    <div class="form-container">
        <h1>Login</h1>
        
        <?php if ($error_message): ?>
            <div class="error-message" style="color: red;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form action="login_proses.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="hidden" name="url_asal" value="<?php echo $url_asal; ?>">
            <input type="submit" value="Login">
        </form>
        <a href="dbregister.php" class="btn-register">Don't have an account? Register</a>
    </div>

</body>

</html>
