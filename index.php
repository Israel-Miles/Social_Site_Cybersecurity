<?php
    require 'config/config.php';

    $query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Izzy')");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello Izzy!
</body>
</html>