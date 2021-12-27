<?php include('partials/menu.php'); ?>

    <?php
        if(isset($_GET['id'])) {
            // Get id variable as passed in via manage category update button
            $id = $_GET['id'];

            // Create query to get selected row from database
            $sql = "SELECT * FROM tbl_category WHERE id=$id; ";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check whether db query executed successfully
            if($res==true) {
                //Check whether data was returned from database
                $count = mysqli_num_rows($res);

                // Check that only one row is returned 
                if($count==1) {
                    // Get data in an associative array
                    $row = mysqli_fetch_assoc($res);

                    // Get individual data items
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                } else {
                    // Set session message
                    $_SESSION['category-not-found'] = "<div class='error'>No Such Category</div>";
                    // Redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

            } else {
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }

    ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1><br><br>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-50">
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current image</td>
                        <td>
                            <?php
                                if($current_image != "") { // If value of current_image variable is not blank i.e If we have an image_name in database
                                    // Display the image
                                    ?>
                                    
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                                    
                                    <?php
                                } else {
                                    // Display message
                                    echo "<div class='error'>Image Unavailable</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No") { echo "checked"; } ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

            // Check whether submit button has been clicked
            if(isset($_POST['submit'])) {
                // Get form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_name = $_POST['current_name'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];


                // If a new image is selected, remove current photo if one was there and replace with new one
                // If a new image is not selected, retain the current one if there was one
                if(isset($_FILES['image']['name'])) { // If $_FILES['image']['name] is set i.e. is not null
                    $image_name = $_FILES['image']['name'];

                    // Check that $image_name is not empty
                    // That we have a new image to replace the old one with
                    if($image_name != "") {
                        // 1. Delete current image if it exists

                        if($current_image != "") { 
                            // 1. Delete current image
                            $path = "../images/category/".$current_image;
                            $remove = unlink($path);

                            // Check whether image was not deleted
                            if($remove==false) {
                                // If image was not deleted, redirect to manage category page with error message then stop process else continue
                                $_SESSION['remove'] = "<div class='error'>Current Image deletion failed</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // Stop process
                                die();
                            }
                        } else {
                            echo "current image is empty";
                        }

                        // 2. Upload New Image
                        // We need: a. New image name b. Source path c. Destination path
                        // a. new image name; Auto rename our image with each database entry
                        // Give each image a unique random name
                        // Get File extension
                        $ext = end(explode(".", $image_name));

                        // Form new image name
                        $image_name = "Food_Category_".rand(000, 999).$ext;

                        // b. Source path
                        $source_path = $_FILES['image']['tmp_name'];
                        // c. Destination path
                        $destination_path = "../images/category/".$image_name;

                        // Move uploaded image from source to destination 
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check if image was not uploaded successfully
                        if($upload==false) {
                            // If upload failed, redirect to manage category page with error message then stop process, else continue
                            $_SESSION['upload'] = "<div class='error'>Image failed to upload</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            // Stop process
                            die();
                        }

                    } else {
                        // If no image is selected, use current image if one exists
                        $image_name = $current_image;

                    }

                } else {
                    // If no image is selected, use current image if one exists
                    $image_name = $current_image;

                }



                // Create sql query to update database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
                    image_name = '$image_name',
                    active = '$active'
                    WHERE id = '$id';
                ";

                // Execute query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether query executed successfully
                if($res2 == true) {
                    // Redirect to manage category page with success message
                    $_SESSION['update-category'] = "<div class='success'>Update Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                } else {
                    // Redirect to manage category with error message
                    $_SESSION['update-category'] = "<div class='error'>Update Failed</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>