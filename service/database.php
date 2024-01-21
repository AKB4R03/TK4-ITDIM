<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "tk4";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
    echo "konek gak jadi";
    die("error");
}

// echo "yeeeeeeyyyy";