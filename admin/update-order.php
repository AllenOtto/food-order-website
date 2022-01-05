<?php include('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
        <h1>Update Order</h1><br><br>

        <?php
            // Get order details for order id received
            // Check if the id is provided else redirect
            if(isset($_GET['id'])) {
                // Get id of row to update
                $id = $_GET['id'];

                // Get other details from database
                // Create sql to get order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id; ";
                // Execute query
                $res = mysqli_query($conn, $sql);
                // Get row count returned
                $count = mysqli_num_rows($res);
                // Check if result is one
                if($count==1) {
                    // Get row in associative array
                    $row = mysqli_fetch_assoc($res);
                    // Get details
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $qty * $price;
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $status = $row['status'];

                } else {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }


            } else {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer-name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer-contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="email" name="customer-email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea name="" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>