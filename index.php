<?php

    include "service/database.php";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

        $result = $db->query($sql);

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();

            header("loaction: home.php");
        }else {
            echo"gak ada woy";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ini login
    <form action="index.php" method="POST">
    <input type="text" name="username">    
    <input type="password" name="password">    
    <button name="login">login</button>
    </form>
</body>
</html>