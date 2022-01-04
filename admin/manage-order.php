<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Orders</h1><br><br>
            
            <table class="tbl-full">
                        <tr>
                            <th>S.N.</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th>Customer Contact</th>
                            <th>Customer Email</th>
                            <th>Customer Address</th>
                            <th>Actions</th>
                        </tr>

            <?php

            // Create sql query to get orders from database
            $sql = "SELECT * FROM tbl_order";
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
                            <td><a href="#" class="btn-secondary">Edit</a></td>
                        </tr>
                    <?php
                }

            } else{
                // Set session message and redirect
                $_SESSION['order'] = "<div class='error'>No Orders Yet</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }

            ?>
            
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>