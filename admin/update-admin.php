<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1><br><br>

                <?php 
                // Get the ID of the admin to be updated on manage-admin.pho
                $id = $_GET['id'];

                // Create SQL Query to get the admin row selected
                $sql = "SELECT * FROM tbl_admin WHERE id=$id;";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if the query has been executed
                if($res==true) {
                    // Check whether we have data or not
                    $count = mysqli_num_rows($res);

                    // Confirm that we have exactly one result
                    if($count==1) {
                        // Get the result in an associative array
                        $row = mysqli_fetch_assoc($res);

                        // Get indiviadual data items from associative array
                        $full_name = $row['full_name'];
                        $username = $row['username'];

                    } else {
                        // If we recieve no data, Redirect back to manage-admin.php
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            ?>

            <!-- Update form with content to be updated loaded from DB -->
            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $full_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Your Username" value="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>

        </div>
    </div>

    <?php
            
    // Process Data updation
    if(isset($_POST['submit'])) {
        // Get all values from form for updating
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create SQL query to update admin details
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username'
            WHERE id='$id'
        ";

        // Execute SQL query
        $res = mysqli_query($conn, $sql);

        // Check that the query executed successfully
        if($res==True) {
            // Save Success Session message
            $_SESSION['update'] = '<div class="success">Entry Updated Successfully<div>';
            // Redirect user to manage-admin.php
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            // Save Error Session  message
            $_SESSION['update'] = '<div class="error">Update Failed<div>';
        }

    }
            
    ?>

<?php include('partials/footer.php'); ?>