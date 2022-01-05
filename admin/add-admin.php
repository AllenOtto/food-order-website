<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1><br>

            <?php 
                if(isset($_SESSION['add'])) { // checking if the session is set
                    // Display session message if set
                    echo $_SESSION['add'];
                    // Remove session message on page refresh
                    unset($_SESSION['add']);
                }
            ?>
            
            <form action="" method="post">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                    </tr>
                </table>

            </form>
            
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<?php

    // Process the values from the form and save to database
    // Check that the submit button is clicked
    if(isset($_POST['submit'])) {
        // On submit button clicked
        // 1. Get data from form
         $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
         $username = mysqli_real_escape_string($conn, $_POST['username']);
         $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // Password encryption with md5 

         // 2. SQL Query to save data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        // 3. Execute query and save data to database 
        $res = mysqli_query($conn, $sql);

        // 4. Check whether (query is executed) data is inserted into database or not and display appropriate message
        if( $res==True ) {
            // Create a session variable to display message
            $_SESSION['add-admin'] = '<div class="success">Admin added Successfully</div>';
            // Redirect to Manage Admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
            
        } else {
            // Create session variable to display message
            $_SESSION['add-admin'] = '<div class="error">Failed to add Admin</div>';
            // Redirect page to add-admin.php
            header('location:'.SITEURL.'admin/add-admin.php');  
        }
    }

?>