<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1><br>
            
            <?php

            if(isset($_SESSION['add-food'])) { // If session message is not null
                echo $_SESSION['add-food']; // Display session message
                unset($_SESSION['add-food']); // Remove session message on page refresh
            }
            
            if(isset($_SESSION['delete-food-image'])) {
                echo $_SESSION['delete-food-image'];
                unset($_SESSION['delete-food-image']);
            }

            if(isset($_SESSION['delete-food'])) {
                echo $_SESSION['delete-food'];
                unset($_SESSION['delete-food']);
            }

            ?>
            
            <br><br>
            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                
                <?php
                    // Create sql query to get all food from database
                    $sql = "SELECT * FROM tbl_food; ";
                    
                    // Execute query
                    $res = mysqli_query($conn, $sql);
                    
                    // Count rows to check whether there is food or not
                    $count = mysqli_num_rows($res);

                    // Create count variable to number food list items. Set default value as 1.
                    $sn = 1;

                    if($count>0) {
                        // We have food in database
                        // Get the food from database
                        while($row=mysqli_fetch_assoc($res)) {
                            // Get individual food data items
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        // Check whether we have an image or not
                                        if($image_name != "") {
                                            // If there is an image added for this food item
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width='100px'>
                                            <?php

                                        } else {
                                            // If there is no image
                                            echo "<div class='error'>No Image Available</div>";
                                        }
                                    ?>
                                    
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Details</a> 
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>

                            <?php

                        }

                    } else {
                        // There is no food added in database
                        echo "<tr><td colspan='7' class='error'>Food Not Added Yet</td></tr>";
                    }

                ?>
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>