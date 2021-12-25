<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Categories</h1><br>

            <?php
                if(isset($_SESSION['add-category'])) {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }

                if(isset($_SESSION['unlink-image'])) {
                    echo $_SESSION['unlink-image'];
                    unset($_SESSION['unlink-image']);
                }

                if(isset($_SESSION['delete-category'])) {
                    echo $_SESSION['delete-category'];
                    unset($_SESSION['delete-category']);
                }

                if(isset($_SESSION['category-not-found'])) {
                    echo $_SESSION['category-not-found'];
                    unset($_SESSION['category-not-found']);
                }
                
                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['update-category'])) {
                    echo $_SESSION['update-category'];
                    unset($_SESSION['update-category']);
                }

                if(isset($_SESSION['image-not-selected'])) {
                    echo $_SESSION['image-not-selected'];
                    unset($_SESSION['image-not-selected']);
                }

                if(isset($_SESSION['remove'])) {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
            ?>
            
            <br><br>
            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>image Name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    // Query to get all entries from database
                    $sql = "SELECT * FROM tbl_category";

                    // Execute query
                    $res = mysqli_query($conn, $sql);

                    // Check if query executed successfully
                    if($res==true) {
                        //Check if there is data in query result
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0) { // There are rows/entries in $res
                            // Get data entries in an associative array
                            while($row=mysqli_fetch_assoc($res)) {
                                // Using while loop to get all data from DB
                                // While loop will run as long as we have data in DB

                                // Get individual data items
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                // Display db entries in table

                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            if($image_name != "") {
                                                // Display image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" width="100px">
                                                <?php

                                            } else {
                                                // Display error message
                                                echo "<div class='error'>No Image Available.</div>";

                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Details</a> 
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>

                                <?php

                            }

                        } else {
                            // If we have no data in database table
                            ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="error">No Categories Added</div>
                                    </td>
                                </tr>
                            <?php
                        }
                    }

                ?>

            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>