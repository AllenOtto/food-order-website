<?php include('../config/constants.php'); ?>

<?php
    // Check if the delete button is set 
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Get id and image_name from food item delete button on food manage page
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Check if there is an image associated with the food item of said id
        if($image_name != "") { // If there is, take the image name so you can to delete the image
            // To delete image, we need the path to the image and the image name
            $path = "../images/food/".$image_name;
            // Delete the image from food folder
            $remove = unlink($path);

            // Check if deletion failed, output error message and stop process 
            if($remove == false) {
                // Redirect to manage food page with error message 
                $_SESSION['delete-food-image'] = "<div class='error'>Food Image Failed to Delete</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process
                die();
            }
        }

        // If either there is no image to delete or image has been deleted successfully
        // Proceed with deleting row data from the database at specified id
        // Create sql query to delete data from database at said id
        $sql = "DELETE FROM tbl_food WHERE id=$id; ";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check if query executed successfully
        if($res==True) {
            // Redirect to manage food page with success message
            $_SESSION['delete-food'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            $_SESSION['delete-food'] = "<div class='error'>Food Deletion Failed</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    } else {
        // Redirect back to manage food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>