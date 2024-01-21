<?php
include "service/database.php";
session_start();

if (isset($_SESSION["isLogin"])) {
    header("location: home.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Debugging
    echo "Password before hash: $password<br>";
    
    $hashPW = hash("sha256", $password);
    
    // Debugging
    echo "Hashed password: $hashPW<br>";
    
    try {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashPW')";
        
        if ($db->query($sql)) {
            $registerMessage = "Pendaftaran berhasil";
        } else {
            $registerMessage = "Pendaftaran gagal: " . $db->error;
        }
    } catch (mysqli_sql_exception $e) {
        $registerMessage = "Pendaftaran gagal: " . $e->getMessage();
    }

    $db->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title>Document</title>
</head>

<body>
    <i><?= $registerMessage ?></i>
    ini register

    <form action="register.php" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button name="register">register</button>
    </form>
</body>

</html>