<?php include('partials/menu.php'); ?>

<?php

    // Get id of row to be updated (if update food button on manage food page is set)
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Create sql query to get details of row specified by given id to populate our update form
        $sql = "SELECT * FROM tbl_food WHERE id=$id; ";

        // Execute query
        $res = mysqli_query($conn, $sql);

        // Check whether we have data or not
        $count = mysqli_num_rows($res);

        if($count>0) {
            // Get data in an associative array
            $row = mysqli_fetch_assoc($res);

            // There's data so get individual data items
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $category_id = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];

        }
    } 

?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1><br><br>


            <br>

            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>" min="0" max="10000" step="5"></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        </td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <?php
                                    // Create query to get all categories where active = "Yes"
                                    $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'; ";
                                    // Execute query
                                    $res2 = mysqli_query($conn, $sql2);
                                    // Check if there is data
                                    $count2 = mysqli_num_rows($res2);
                                    if($count2>0) {
                                        // Get data as an associative array for all data in database and populate table
                                        while($row2=mysqli_fetch_assoc($res2)) {
                                            // Get data items
                                            $category_id = $row2['id'];
                                            $category_title = $row2['title'];

                                            ?>
                                                <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php

                                        }
                                        
                                    }

                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured=="Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                // Check that the submit button is clicked
                if(isset($_POST['submit'])) {
                    //Get post data
                    // Passed hidden
                    $id = $_POST['id'];
                    $current_image = $_POST['current_image'];

                    // Passed normally
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category_id = $_POST['category'];

                    // Check if featured and active have been assigned values 
                    // If not give default value of No
                    if(isset($_POST['featured'])) {
                        $featured = $_POST['featured'];
                    } else {
                        $featured = "No";
                    }

                    if(isset($_POST['featured'])) {
                        $active = $_POST['active'];
                    } else {
                        $active = "No";
                    }

                    // Work on image upload if there is an image to be uploaded
                    // Check that the image variable is not null
                    if(isset($_FILES['image']['name'])) {
                        // if it is set assign it to the $image_name variable
                        $image_name = $_FILES['image']['name'];

                        // Check that the image_name variable is not empty
                        if($image_name != "") {
                            // Since a new image has been selected for updating
                            // Check if there was an image previously allocated this space
                            // If yes, delete it and replace it with new image
                            if($current_image != "") {
                                // There is a current image: Unlink it
                                // To delete current image we need the path to it
                                $path = "../images/food/".$current_image;
                                // Unlink it
                                $remove = unlink($path);
                                // Check whether unlinking failed. If not proceed.
                                if($remove == false) {
                                    // If it failed: Redirect to manage food page with error message and stop the process
                                    $_SESSION['failed-to-delete-current-image'] = "<div class='error'>Failed to Delete Current Image</div>";
                                    // Redirect to manage food page
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    // Stop process
                                    die();
                                }

                            }

                            // If either there is no current image or image deletion was successful
                            // Upload new image to images/food folder
                            // To uplad new image we need the image name, path to image source (temp) and path to destination folder
                            // Randomize image name to prevent potential overwrite due to same name in destination folder
                            // Get file extension first
                            $extension = end(explode(".", $image_name));
                            // New Image Name
                            $image_name = "Food_Item_".rand(000,999).".".$extension;
                            // Path to image source
                            $source_path = $_FILES['image']['tmp_name'];
                            // Path to destination folder
                            $destination_path = "../images/food/".$image_name;
                            // Move image from temporary source folder to destination folder
                            $upload = move_uploaded_file($source_path, $destination_path);
                            // Check if image upload failed else proceed.
                            // If it did fail, stop the process and redirect to manage food page with error message
                            if($upload == false) {
                                $_SESSION['image-upload'] = "<div class='error'>Image Upload Failed</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }

                        
                        } else {
                            // Set image_name variable to previous image value
                            $image_name = $current_image;
                        }
                    
                    } else {
                        // Set image_name variable to previous image value
                        $image_name = $current_image;
                    }

                    // Upload Data to database
                    // Create sql query to update database
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category_id,
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id;
                    ";

                    // Execute query
                    $res3 = mysqli_query($conn, $sql3);

                    // Check whether query executed successfully
                    if($res3 == true) {
                        // It's successful
                        // Redirect to Manage Food page with success message 
                        $_SESSION['update-food'] = "<div class='success'>Food Updated Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                    } else {
                        // It Failed
                        // Redirect to Manage Food page with error message
                        $_SESSION['update-food'] = "<div class='error'>Food Failed to Update</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                    }


                }

            ?>

        </div>

    </div>
    
<?php include('partials/footer.php'); ?>