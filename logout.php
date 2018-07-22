<?php
    session_start();
    include("includes.inc");
    $_SESSION['login_user'] = "";
    $_SESSION['user_type'] = 0;
    header('Location: index.php');
?>