<?php
    $con = mysqli_connect("localhost", "root", "", "social");
    
    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    // Declaring variables to prevent errors
    $first_name = "";
    $last_name = "";
    $email = "";
    $email2 = "";
    $password = "";
    $password2 = "";
    $signup_date = "";
    $error_array = "";

    if(isset($_POST['register_button'])){

        // TODO: add strip_tags() for enhanced security (removes html tags)
        $first_name = $_POST['reg_fname'];
        $first_name = str_replace(' ', '', $first_name);
        $first_name = ucfirst(strtolower($first_name)); // Uppercase first letter

        $last_name = $_POST['reg_lname'];
        $last_name = str_replace(' ', '', $last_name);
        $last_name = ucfirst(strtolower($last_name));

        $email = $_POST['reg_email'];
        $email = str_replace(' ', '', $email);
        $email = ucfirst(strtolower($email));

        $email2 = $_POST['reg_email2'];
        $email2 = str_replace(' ', '', $email2);
        $email2 = ucfirst(strtolower($email2));

        $password = $_POST['reg_password'];
        $password2 = $_POST['reg_password2'];

        $date = date("Y-m-d");

        if($email == $email2) {
            // Check if emails in valid format
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            }
            else {
                echo "Invalid format";
            }
        }
        else {
            echo "Emails don't match";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Coronagram!</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" required>
        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" required>
        <br>
        <input type="email" name="reg_email" placeholder="Email" required>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" required>
        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>