<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1><br><br>

            <?php

                // Wrong password for user at specified id
                if(isset($_SESSION['password-mismatch'])) {
                    echo $_SESSION['password-mismatch'];
                    // unset session variable on page refresh
                    unset($_SESSION['password-mismatch']);
                }
             
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }

            ?>
            <br>
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
        // Check if submit button is clicked
        if(isset($_POST['submit'])) {
            // Get form data
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // Check if user of id given has password matching one given
            // Create SQL statement to get user of said ID with said Password
            $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password' ;";

            // Execute SQL query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully and so user with said id has said password
            if($res==true) {
                // Check whether there is data in sql result
                $count = mysqli_num_rows($res);

                if($count==1) { // There should be only one user matching the qualifications of the sqli query
                    // User exists and password can be changed
                    // Check if new password and password confirmation match
                    if($new_password==$confirm_password) {
                        // Password confirmation passed.
                        // Create sql statement to Update the password
                        $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id='$id';
                        ";
                        
                        // execute sql statement 
                        $res2 = mysqli_query($conn, $sql2);

                        if($res2==true) {
                            // Set success session message and redirect
                            $_SESSION['password-update'] = "<div class='success'>Password Updated</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        } else {
                            // Set success session message and redirect
                            $_SESSION['password-update'] = "<div class='error'>Password Updation Failed</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }

                    } else {
                        // New password confirmation failed. Passwords do not match
                        // Session success message
                        $_SESSION['password-mismatch'] = "<div class='error'>Password Confirmation Failed</div>";
                        // Redirect user to manage admin page
                        header('location:'.SITEURL.'admin/update-password.php');
                    }

                } else {
                    // User doesn't exist. Set session message and redirect
                    $_SESSION['wrong-password'] = "<div class='error'>Wrong password</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
             
            }

        }    
    ?>

<?php include('partials/footer.php') ?>