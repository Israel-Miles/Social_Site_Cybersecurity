<?php
    include("../../config/config.php");
    include("../classes/User.php");
    include("../classes/Post.php");

    $limit = 5;

    $posts = new Post($con, $_REQUEST['userLoggedIn']);
    $posts->loadPostsFriends($_REQUEST, $limit);
?>