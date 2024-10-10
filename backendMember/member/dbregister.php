<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css"> 
    <link rel="icon" href="icon/logo.png" type="image/png">
</head>
<body>

    <div class="form-container">
        <h1>Register</h1>
        <form action="register_proses.php" method="POST">
            <input type="text" name="fname" placeholder="First Name" required><br>
            <input type="text" name="lname" placeholder="Last Name" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Register">
        </form>
    </div>

</body>
</html>