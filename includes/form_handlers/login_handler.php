<?php
if(isset($_POST['login_button'])) {
    $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);

    $_SESSION['login_email'] = $email;
    $password = md5($_POST['login_password']);

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = $check_database_query->num_rows;

    if($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
        if($user_closed_query->num_rows == 1) {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else {
        array_push($error_array, "Email or password was incorrect<br>");
    }
}

?>