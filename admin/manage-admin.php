<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admins</h1><br>

            <?php 
                if(isset($_SESSION['add-admin'])) { // Checking if the session is set
                    // If session is set, display session message
                    echo $_SESSION['add-admin'];
                    // Remove session message on page refresh 
                    unset($_SESSION['add-admin']);
                }

                if(isset($_SESSION['delete-admin'])) {
                    // If session variable has content, display it
                    echo $_SESSION['delete-admin'];
                    // Remove session message on page refresh
                    unset($_SESSION['delete-admin']);
                }

                //Password Update session message
                if(isset($_SESSION['password-update'])) {
                    // If password_update session variable has been assigned a message
                    echo $_SESSION['password-update'];
                    // Unset/Empty password_update session variable on page refresh
                    unset($_SESSION['password-update']);
                } 

                // Wrong password for user at specified id
                if(isset($_SESSION['wrong-password'])) {
                    echo $_SESSION['wrong-password'];
                    // unset session variable on page refresh
                    unset($_SESSION['wrong-password']);
                }

            ?>

            <br><br><br>
            
            <!-- Button to add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>Serial #</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                    // Query to get all admins from database
                    $sql = "SELECT * FROM tbl_admin";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);
                    // Check whether the query is executed or not and respond appropriately
                    if($res==TRUE) {
                        // Count rows to check if we have data in database or not
                        $count = mysqli_num_rows($res); // Function to get all rows in database
                        
                        $sn=1;

                        if ($count>0) { // We have rows in DB
                            while($rows=mysqli_fetch_assoc($res))
                            { 
                                // Using while loop to get all data from DB
                                // While loop will run as long as we have data in DB

                                // Get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                // Display individual data items in our table
                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?> . </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Update Password</a> 
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Details</a> 
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
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