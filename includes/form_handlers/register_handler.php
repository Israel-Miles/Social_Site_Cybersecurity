<?php
// Declaring variables to prevent errors
$first_name = "";
$last_name = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$signup_date = "";
$error_array = array();

if(isset($_POST['register_button'])){

    // TODO: add strip_tags() for enhanced security (removes html tags)
    $first_name = $_POST['reg_first_name'];
    $first_name = str_replace(' ', '', $first_name);
    $first_name = ucfirst(strtolower($first_name)); // Uppercase first letter
    $_SESSION['reg_first_name'] = $first_name; // Stores first name into session variable

    $last_name = $_POST['reg_last_name'];
    $last_name = str_replace(' ', '', $last_name);
    $last_name = ucfirst(strtolower($last_name));
    $_SESSION['reg_last_name'] = $last_name;

    $email = $_POST['reg_email'];
    $email = str_replace(' ', '', $email);
    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email'] = $email;

    $email2 = $_POST['reg_email2'];
    $email2 = str_replace(' ', '', $email2);
    $email2 = ucfirst(strtolower($email2));
    $_SESSION['reg_email2'] = $email2;

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
                array_push($error_array, "Email already in use<br>");
            }
        }
        else {
            array_push($error_array, "Invalid email format<br>");
        }
    }
    else {
        array_push($error_array, "Emails don't match<br>");
    }

    if(strlen($first_name) > 25 || strlen($first_name) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
    }

    if(strlen($last_name) > 25 || strlen($last_name) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
    }

    if($password != $password2) {
        array_push($error_array, "Your passwords do not match<br>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your password can only contain english characters or numbers<br>");
        }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }

    if(empty($error_array)) {
        $password = md5($password); // Encrypt password

        // Generate username
        $username = strtolower($first_name . "_" . $last_name);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        // if username exists add number to username
        while($check_username_query->num_rows != 0) {
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        $rand_num = rand(1,2);

        if($rand_num == 1)
            $profile_pic = "assets/images/profile_pics/defaults/corona.jpg";
        else if($rand_num == 2)
            $profile_pic = "assets/images/profile_pics/defaults/trump.jpg";

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$first_name', '$last_name', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

        $_SESSION['reg_first_name'] = "";
        $_SESSION['reg_last_name'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}
?>