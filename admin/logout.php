<?php
    // Include constants.php for SITEURL Function
    include('../config/constants.php');

    // Destroy session
    session_destroy();

    // Redirect user to login page
    header('location:'.SITEURL.'admin/login.php');

?>