<?php include('partials/menu.php'); ?>

    <?php
        if(isset($_GET['id'])) {
            // Get id and image_name variables as passed in via href url
            $id = $_GET['id'];

            // Create query to get selected row from database
            $sql = "SELECT * FROM tbl_category WHERE id='$id'; ";

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
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

            // Check if submit button is clicked
            if(isset($_POST['submit'])) {
                // Get form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                
                // Check if image is uploaded
                if(isset($_FILES['image']['name'])) {
                    // To upload image we need image name, source path and destination path
                    // 1. Get Image Name 
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "") { 
                        // If $image_name is populated, then the previous image needs to be unlinked
                        // Path to previous image
                        $path = "../images/category/".$image_name;
                        // Unlink image
                        $remove = unlink($path);

                        // Image uploading is only attempted if an image is selected ie. the image_name variable is populated
                        // Rename the image to have unique names for each uploaded image
                        // Use the expload method to isolate the image extension
                        $ext = end(expload('.', $image_name));
                        //Rename the image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        // 2. Get Source Path for Image
                        $source_path = $_FILES['image']['tmp_name'];
                        
                        // 3. Get destination path for image
                        $destination_path = "../images/category/".$image_name;

                        // Upload image
                        $upload = move_uploaded_file($source_path, $destination_path);
                    }

                    
                } else {
                    // If none is selected display message
                    $image_name = "";
                }

                // Check if option selected for featured
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    // If no option selected, give default 'No'
                    $featured = "No";
                }

                // Check if option selected for active
                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    // If no option selected, give default 'No'
                    $active = "No";
                }

                // Create SQL query to update database 
                $sql = "UPDATE tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id='$id';
                ";

                // $res = mysqli_query($conn, $sql);
            }

            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>