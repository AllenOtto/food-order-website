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
                    <td><textarea name="customer-address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered") { echo "selected"; } ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery") { echo "selected"; } ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered") { echo "selected"; } ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled") { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            // Check if submit button is clicked
            if(isset($_POST['submit'])) {
                // Get form data
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $qty * $price;
                $status = $_POST['status'];
                $customer_name = $_POST['customer-name'];
                $customer_contact = $_POST['customer-contact'];
                $customer_email = $_POST['customer-email'];
                $customer_address = $_POST['customer-address'];

                // Create query to update values
                $sql2 = "UPDATE tbl_order SET
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id;
                ";

                // Execute query
                $res2 = mysqli_query($conn, $sql2);
                // Check if query executed successfully
                if($res2 == true) {
                    // Set session message and redirect
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    // Set session message and redirect
                    $_SESSION['update'] = "<div class='error'>Order Failed to Updated</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>