<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            
            <!-- Add Category Form Starts Here -->
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Enter Category Name"></td>
                    </tr><br>
                    <tr>
                        <td>Image Name: </td>
                        <td><input type="text" name="image-name" placeholder="Enter Image Name"></td>
                    </tr><br>
                    <tr>
                        <td>Featured: </td>
                        <td><input type="radio" name="featured"></td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td><input type="radio" name="active"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Add Category Form Ends Here -->

        </div>
    </div>

    <?php
        if(isset($_POST['submit'])) {
            // Get table data
            $title = $_POST['title'];
            $image_name = $_POST['image-name'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
    
            // Create sql query to save category to database
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active';
            ";
            
            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if($res==true) {
                // Data was inserted into database properly
                // Set success session message and redirect to category-manage page
                $_SESSION['add-category'] = "<div class='success'>Category added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            } else {
                // Data insertion failed
                // Set fail session message, redirect to manage category page
                $_SESSION['add-category'] = "<div class='error'>Failed to add category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            }
        }
    ?>

<?php include('partials/footer.php'); ?>