<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1><br>

            <?php
                if(isset($_SESSION['add-category'])) {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }

                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br>
            <!-- Add Category Form Starts Here -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-50">
                    <tr>
                        <td>Title </td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="add category" class="btn-secondary">
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

            // For input type radio and checkbox we need to check
            // whether the button is checked or not. Sometimes neither
            // Yes or No option is checked
            if(isset($_POST['featured'])) {
                // Get the value if button is selected
                $featured = $_POST['featured'];
            } else {
                // Give a default value if neither is selected
                $featured = "No";
            }

            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Check whether image is selected or not and 
            // set the value for image name accordingly
            // print_r($_FILES['image']);

            // die(); // Beeak the code here

            if(isset($_FILES['image']['name'])) {
                // Upload Image
                // To upload image we need image name, source name and destination name
                $image_name = $_FILES['image']['name'];

                if($image_name != "") {
                    // Auto rename our image
                    // Get the image extension eg. jpg, jpeg, png etc
                    $ext = end(explode('.', $image_name));

                    // Rename the image
                    $image_name = "Food_Category_".rand(000,999).".".$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    // If not uploaded stop the process and redirect user with error message
                    if($upload==false) {
                        // Not Uploaded
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        // Stop the process
                        die();
                    }

                } else {
                    // Don't upload image: Set its value as blank
                    $image_name = "";
                }
            }
    
            // Create sql query to save category to database
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                active='$active',
                featured='$featured';
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
                header('location:'.SITEURL.'admin/add-category.php');

            }
        }
    ?>

<?php include('partials/footer.php'); ?>
