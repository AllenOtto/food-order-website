<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1><br><br>


            <br>

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
                        $id_db = $row['id'];
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
                                            $id_category = $row2['id'];
                                            $title_category = $row2['title'];

                                            ?>
                                                <option value="<?php echo $id_category; ?>"><?php echo $title_category; ?></option>
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
                            <input type="hidden" name="id-db" value="<?php echo $id_db ?>">
                            <input type="hidden" name="current-image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                if(isset($_POST['submit'])) {
                    // Passed Hidden
                    $id_db = $_POST['id-db'];
                    $current_image = $_POST['current-image'];

                    // Get the rest of the data items
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category_id = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    if(isset($_FILES['image']['name'])) {
                        $image_name = $_FILES['image']['name'];
                        // Check if we have a new image selected so as to replace current image
                        if($image_name != "") { // New image is selected
                            // Check if current image variable holds an image we should replace or not
                            if($current_image != "") {
                                // We have an old image we need to delete
                                // We need its path and name
                                $path = "../images/food/".$current_image;
                                // Delete it
                                $remove = unlink($path);
                                // Check if it failed to delete, set a session error message, 
                                // redirect food manage page and stop the process
                                if($remove==false) {
                                    $_SESSION['failed-to-delete-current-image'] = "<div class='error'>Failed to Delete Current Image</div>";
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    die();
                                }

                            }

                        } else {
                            // If no new image is set, set image name variable to empty
                            $image_name = $current_image;
                        }

                        // Since there is a new image, rename it (randomizing it) and upload it
                        // Fetch image extension for reuse
                        $ext = end(explode(".", $image_name));

                        $image_name = "Food_Item_".rand(0000,9999).".".$ext;

                        // To upload it we need its source path, its destination path and its name
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check if image upload failed.
                        // If it did, redirect to food manage page with error message and stop the process
                        if($upload==false) {
                            $_SESSION['new-image-upload-failed'] = "<div class='error'>Image Upload Failed</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                    } else {
                        // If no new image is uploaded retain previous image
                        $image_name = $current_image; // If there was no current image then it's still okay
                    }

                    // Create an sql query to update database
                    $sql3 = "UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price='$price',
                        image_name='$image_name',
                        category_id='$category_id',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id_db;
                    ";

                    // Execute query
                    $res3 = mysqli_query($conn, $sql3);
                    // Check whether the query executed successfully
                    if($res3==True) {
                        echo "Success";
                    } else {
                        echo "Failed";
                    }

                }

            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>