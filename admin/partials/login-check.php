<?php
    // Authorization - Access Control
    // Check whether the user is logged in or not
    if(!isset($_SESSION['user'])) {
        // User is not logged in.
        // Redirect to login page with message
        $_SESSION['login-fail'] = "<div class='error'>Login Failed. Try Again</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>