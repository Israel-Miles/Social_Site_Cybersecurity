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
            // Check if email in valid format
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                // Check if email exists
                $email_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                // Count number of rows returned
                $num_rows = $email_check->num_rows;

                if ($num_rows > 0) {
                    echo "Email already in use";
                }
            }
            else {
                echo "Invalid format";
            }
        }
        else {
            echo "Emails don't match";
        }

        if(strlen($first_name) > 25 || strlen($first_name) < 2) {
            echo "Your first name must be between 2 and 25 characters";
        }

        if(strlen($last_name) > 25 || strlen($last_name) < 2) {
            echo "Your last name must be between 2 and 25 characters";
        }

        if($password != $password2) {
            echo "Your passwords do not match";
        }
        else {
            if(preg_match('/[A-Za-z0-9]/', $password)) {
                echo "Your password can only contain english characters or numbers";
            }
        }

        if(strlen($password) > 30 || strlen($password) < 5) {
            echo "Your password must be between 5 and 30 characters";
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