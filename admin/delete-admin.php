<?php
    // Include the constants.php file in order to use $conn to connect to DB
    include('../config/constants.php');

    // Get the ID of the admin to be deleted
    $id = $_GET['id'];

    // Create SQL Query to DELETE the admin row selected
    $sql = "DELETE FROM tbl_admin WHERE id=$id;";

    // Execute the query
    $res = mysqli_query($conn, $sql);
    
    if($res==true) {
        // Query executed successfully and admin deleted
        // Display Success Message
        $_SESSION['delete'] = '<div class="success">Admin Deleted Successfully</div>';
        // Redirect user to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to execute properly and so admin NOT deleted
        // Display Fail Message

        $_SESSION['delete'] = '<div class="error">Deletion Failed</div>';
        //Redirect user to manage-admin.php
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>

