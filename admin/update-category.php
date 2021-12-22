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
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Create sql query to update database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    featured = '$featured',
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