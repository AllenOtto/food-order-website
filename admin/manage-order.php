<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Orders</h1><br><br>

            <?php
                if(isset($_SESSION['update'])) { // Check if session message is set
                    echo $_SESSION['update']; // Display session message
                    unset($_SESSION['update']); // Remove session message on page refresh
                }
            ?>
            
            <br>
            <table class="tbl-full text-center">
                        <tr>
                            <th>S.N.</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>

            <?php

            // Create sql query to get orders from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display latest order first
            // Execute query
            $res = mysqli_query($conn, $sql);
            // Get row count
            $count = mysqli_num_rows($res);
            // Create counter for row display with a default value of 1
            $sn = 1;
            // Check whether there is data or not
            if($count>0) {
                // Get data in an associative array
                while($row=mysqli_fetch_assoc($res)) {
                    // Get individual data items
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    ?>
                        
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td><a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a></td>
                        </tr>
                    <?php
                }

            } else{
                // Display error message
                echo "<tr colspan='12'><td class='error'>No Orders Yet</td></tr>";
            }

            ?>
            
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>