<?php
include "service/database.php";
session_start();

if (!isset($_SESSION["isLogin"]) || !$_SESSION["isLogin"]) {
    header("location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $UserId = $_SESSION["UserId"];
    $itemId = (int)$_GET['id'];

    // Perform the deletion
    $deleteResult = $db->query("DELETE FROM stuff WHERE UserId = '$UserId' AND id = '$itemId'");

    if ($deleteResult) {
        header("location: home.php"); // Redirect back to home.php after successful deletion
        exit();
    } else {
        // Handle the error if needed
        $error = $db->error;
        echo "Error deleting stuff: $error";
    }
} else {
    echo "Invalid or missing item ID";
}

$db->close();