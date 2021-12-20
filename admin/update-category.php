<?php include('partials/menu.php'); ?>

    <?php
        if(isset($_GET['id'])) {
            // Get id and image_name variables as passed in via href url
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

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
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                } else {
                    // Set session message
                    $_SESSION['category-not-found'] = "<div class='error'>No Such Category Found</div>";
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
                        <td><input type="file" name="current-image" value="<?php echo $image_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image-name" value="<?php echo $image_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php'); ?>