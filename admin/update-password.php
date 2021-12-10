<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1><br><br>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }

            ?>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current_password"></td>
                    </tr>
                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new_password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
    <?php 

        if(isset($_POST['submit'])) {
            // Get data from form
            $id = $_POST['id']."<br>";
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // Check whether a user at current table ID has current_password
            $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password';";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if($res==true) {
                // Check whether data is available
                $count = mysqli_num_rows($res);
                if($count==1) {
                    // Retrieve result in an associative array
                    $row = mysqli_fetch_assoc($res);

                    $password_from_db = $row['password'];

                    // Compare original pwd with one entered by user to check match
                    if($password_from_db==$current_password) { // If its a match, replace current password in DB with new password
                        // If new_password is identical to confirm_password
                        if($new_password==$confirm_password) {
                            // SQL Statement to save new password to database
                            $sql2 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id='$id'
                                ";

                            // Execute query
                            $res2 = mysqli_query($conn, $sql2);
                            
                            // Check if query executed successfully
                            if($res2==true) {
                                // Password updated successfully
                                // Save success session message to session variable 
                                $_SESSION['password-update'] = "<div class='success'>Password Updated Successfully</div>";
                                // Redirect user to manage admin page
                                header('location: '.SITEURL. 'admin/manage-admin.php');

                            } else {
                                // Password update failed
                                // Save error session message to session variable
                                $_SESSION['wrong-password'] = "<div class='error'>Password Update Failed</div>";
                                // Redirect user to manage admin page
                                header('location: '.SITEURL. 'admin/manage-admin.php');
                                
                            }

                        } else {
                            // If new password and confirm password don't match
                            $_SESSION['pwd-mismatch'] = "<div class='error'>Password Confirmation Failed</div>";
                            // Redirect to manage admin page
                            header('location: '.SITEURL.'admin/manage-admin.php');
                        }

                    } else {
                        // If password verification failed
                        $_SESSION['password-update'] = "<div class='error'>Wrong Current Password</div>";
                        // Redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            }
        }


        //Password Update session message
        if(isset($_SESSION['password-update'])) {
            // If password_update session variable has been assigned a message
            echo $_SESSION['password-update'];
            // Unset/Empty password_update session variable on page refresh
            unset($_SESSION['password-update']);
        } 


    ?>

<?php include('partials/footer.php') ?>