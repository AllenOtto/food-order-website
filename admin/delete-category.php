<?php
    // Include constants.php file
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {

        // Get id value of item to be deleted from manage category category entry delete button href url
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available. Else do nothing
        if($image_name != "") {
            // Image file available. Remove it
            // Define path to image file
            $path = "../images/category/".$image_name;

            // Remove the image using built-in function 'unlink'. Unlink returns boolean value. True if successful
            $remove = unlink($path);

            if($remove==false) {
                // If fails to remove image, set error message, redirect to manage category page and stop process
                $_SESSION['unlink-image'] = "<div class='error'>Failed to Delete Category Image</div>";

                // Redirect 
                header('location:'.SITEURL.'admin/manage-category.php');

                // Stop the process so as not to delete data from database
                die();
            }
        }

        // Create Sql query to delete tbl_category entry of selected id
        $sql = "DELETE FROM tbl_category WHERE id='$id'; ";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if query executed successfully
        if($res==true) {
            // Category deleted successfully
            // Redirect to category management page and Display success message
            $_SESSION['delete-category'] = "<div class='success'>Category Deleted Successfully</div>";
            
            // Redirect
            header('location:'.SITEURL.'admin/manage-category.php');

        } else {
            // Category deletion failed
            // Redirect to category management page and Display success message
            $_SESSION['delete-category'] = "<div class='error'>Category Deletion Failed</div>";

            // Redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    } else {
        // Redirect to manage-category.php page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>