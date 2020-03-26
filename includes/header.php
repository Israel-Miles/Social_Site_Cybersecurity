<?php
    require 'config/config.php';

    if (isset($_SESSION['username'])) {
        $user_logged_in = $_SESSION['username'];
    }
    else {
        header("Location: register.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>