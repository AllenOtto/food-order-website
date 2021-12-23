<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-50">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Add Title"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5">

                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price (KES)</td>
                    <td><input type="number" name="price" min="0" max="10000" step="5"></td>
                </tr>
                <tr>
                    <td>Image Name</td>
                    <td>
                        <input type="file" name="image">
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
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>
            </table>

        </form>

        <?php

        // Check if submit button is clicked
        if(isset($_POST['submit'])) {
            // Get form data
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
           
            // If image name is not null, save image name else save error message to database
            if(isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                // if image_name variable has value
                if($image_name != "") {
                    // Image name variable has value. Save image name to database and upload image to images/food/ folder
                    // To upload an image we need: the image name, source path of image's current storage
                    // and destination path to new image storage
                    // a. Image name is stored in $image_name
                    // Get image extension from $image_name
                    $ext = end(explode(".", $image_name)); 
                    // Rename the image and give it a randomness so that uploaded images don't override in destination folder
                    $image_name = "Food_Item_".rand(000, 999).".".$ext;
                    // Get source path
                    $source_path = $_FILES['image']['tmp_name'];
                    // Get destination path
                    $destination_path = "../images/food/".$image_name;

                    // Move file from source (temporary storage) to destination (your chosen folder)
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload==false) {
                        //Redirect to manage food page with error message
                        $_SESSION['upload'] = "<div class='error'>Image Upload Failed</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                } else {
                    $image_name = "";

                }

            } else {
                $image_name = "";
            }
            
            // Get user set value else set value as 'No'
            if(isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            
            // Get user set value else set value as 'No'
            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Create Sql query to add data to database
            $sql = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active';
            ";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if($res == true) {
                // Redirect with session success message  
                $_SESSION['add-food'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                // Redirect with session error message
                $_SESSION['add-food'] = "<div class='error'>Failed to Add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }


        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>