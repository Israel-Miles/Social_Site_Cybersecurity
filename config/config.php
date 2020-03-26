<?php
    ob_start(); // Turns on output buffering
    session_start();

    $timezone = date_default_timezone_set("America/Denver");


    $con = mysqli_connect("localhost", "root", "", "social");
    
    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    $query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Izzy')");
?>