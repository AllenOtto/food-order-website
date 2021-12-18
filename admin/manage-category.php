<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Categories</h1><br>

            <?php
                if(isset($_SESSION['add-category'])) {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
            ?>
            
            <br><br>
            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>Serial #</th>
                    <th>Title</th>
                    <th>image Name</th>
                    <th>Featured</th>
                    <th>Active</th>
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
                            while($rows=mysqli_fetch_assoc($res)) {
                                // Using while loop to get all data from DB
                                // While loop will run as long as we have data in DB

                                // Get individual data items
                                $title = $rows['title'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];

                                // Display db entries in table

                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $image_name ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                </tr>

                                <?php

                            }
                        }
                    }

                ?>

            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>