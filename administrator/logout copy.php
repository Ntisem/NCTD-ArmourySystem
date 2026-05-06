<?php
    // session_start();
    // // Destroy session
    // if(session_destroy()) {
    //     // Redirecting To Home Page
    //     header("Location: login.php");
    // }
    session_start();
    $redirect_link_var = $_SESSION['page_url'];
    unset($_SESSION['LAST_ACTIVE_TIME']);
    unset($_SESSION['IS_LOGIN']);
    header('location:../login?page_url='.$redirect_link_var.'');
    // header('location:login');
    die();
?>