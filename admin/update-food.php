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
            $current_category = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];

        }
    
    } else {
        // If id variable is not set redirect to manage food page
        header('location:'.SITEURL.'admin/manage-food.php');
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
                            <?php
                                if($current_image != "") {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Add Image Please</div>";
                                }
                            ?>
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
                                                <option <?php if($current_category == $category_id) { echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    } else {
                                        // No Categories Added
                                        ?>
                                            <option value="0" class="error">Add Categories to Database</option>
                                        <?php
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
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>

<?php
    // Check whether submit button is clicked
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // Check if a new image upload has been clicked
        if(isset($_FILES['image']['name'])) {
            // A new image has been selected 
            $image_name = $_FILES['image']['name'];

            // Check whether we have an image name in variable
            if($image_name != "") {
                // Delete previous image if it exists
                if($current_image != "") {
                    // Delete current image
                    // To delete an image we need its name and the path to its current folder
                    $path = "../images/food/".$current_image;
                    // Delete current image
                    $remove = unlink($path);
                    // Check whether there's been any error in deletion
                    if($remove==false) {
                        // File deletion failed
                        //Set session error message, redirect and stop process
                        $_SESSION['image-deletion'] = "<div class='error'>Image Deletion Failed</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }

                } else {
                    // If there is no current image, do nothing
                }


                // As there is a new image, upload it
                // To upload an image we need its name, its source_path and its destination_path
                // 1. Image Name: The new image name needs to be randomized so that there is no
                // Conflict in the destination folder leading to overwriting of images already present in destination folder
                // First get image extension
                $extension = end(explode(".", $image_name));
                // Randomize and rename
                $image_name = "food-item-".rand(000,999).".".$extension;
                // Image source_path
                $source_path = $_FILES['image']['tmp_name'];
                // Image destination_path
                $destination_path = "../images/food/".$image_name;
                // Upload file to appropriate food images folder
                $upload = move_uploaded_file($source_path, $destination_path);
                
                // Check if there was any error during image upload
                // If there was stop the process, set a session error message and redirect to food management page
                if($upload==false) {
                    // File failed to upload
                    //Set session error message, redirect and stop process
                    $_SESSION['upload'] = "<div class='error'>Image Failed to Upload</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();

                }

            } else {
                // Retain current image
                $image_name = $current_image;
            }
        
        } else {
            // If no image is selected, retain current image
            $image_name = $current_image;
        }
        
        // If there is no new image, or new image uploaded successfully...
        // Update Database
        // Write sql query to update database
        $sql3 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id;
        ";

        // Execute query
        $res3 = mysqli_query($conn, $sql3);

        // Check whether query executed successfully or not
        if($res3==True) {
            // If it did, redirect to manage food page with session success message
            $_SESSION['update-food'] = "<div class='success'>Food Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            // If it did not, redirect to manage food page with session error message
            $_SESSION['update-food'] = "<div class='error'>Failed to Update Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }