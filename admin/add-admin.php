<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1><br><br>
            
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
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']); // Password encryption with md5 

         // 2. SQL Query to save data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        // 3. Execute query and save data to database 
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether (query is executed) data is inserted into database or not and display appropriate message
        if( $res==True ) {
            // Data inserted successfully
            echo "Data inserted successfully!";
        } else {
            // Data insertion failed
            echo "Data insertion failed!";
        }

    }

?>