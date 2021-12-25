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
                <tr>
                    <?php
                        // Create sql query to Get All Food Items from DB
                        $sql = "SELECT * FROM tbl_food";
                        // Execute query
                        $res = mysqli_query($conn, $sql);
                        
                        // Create counter for row numbering
                        $sn=1;

                        // Check whether query executed successfully
                        if($res==True) {
                            // Check that there is data in database 
                            $count = mysqli_num_rows($res);
                            if($count>0) {
                                // There is data in database
                                while($row=mysqli_fetch_assoc($res)) {
                                    // Get data
                                    $title = $row['title'];
                                    $price = $row['price'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];

                                ?>

                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            if($image_name != "") {
                                                // Image is available
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            } else {
                                                ?>
                                                    <div class="error">No Image Available</div>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><a href="#" class="btn-secondary">Edit Details</a> <a href="#" class="btn-danger">Delete Admin</a></td>
                                    
                                <?php

                                }
                            } else {
                                // No data in database
                                // Display error message
                                ?>
                                
                                    <td><div class='error'>No Data in Database</div></td>
                                
                                <?php
                            }
                        }
                    ?>
                    
                </tr>
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>