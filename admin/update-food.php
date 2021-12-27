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
                    $category_id = $_POST['category_id'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                }

            ?>

        </div>

    </div>
    
<?php include('partials/footer.php'); ?>