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
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
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
                        <td><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" name="current-image" width="100px"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <option value="1">pork</option>
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
                            <input type="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php'); ?>