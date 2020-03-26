<?php
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php';
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
        <input type="text" name="reg_first_name" placeholder="First Name" required
            value="<?php 
                if(isset($_SESSION['reg_first_name'])) {
                    echo $_SESSION['reg_first_name'];
                }
            ?>"
        >
        <br>
        <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
        
        <input type="text" name="reg_last_name" placeholder="Last Name" required
            value="<?php 
                if(isset($_SESSION['reg_last_name'])) {
                    echo $_SESSION['reg_last_name'];
                }
            ?>"
        >
        <br>
        <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
        
        <input type="email" name="reg_email" placeholder="Email" required
            value="<?php 
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
            ?>"
        >
        <br>
        <?php 
            if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
            else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
            else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; 
        ?>

        <input type="email" name="reg_email2" placeholder="Confirm Email" required
            value="<?php 
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                }
            ?>"
        >
        <br>

        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <?php 
            if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
            else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
            else if(in_array("Your password must be between 5 and 30 characters<br><br>", $error_array)) echo "Your password must be between 5 and 30 characters<br><br>"; 
        ?>


        <input type="submit" name="register_button" value="Register">
        <br>

        <?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
    </form>
</body>
</html>