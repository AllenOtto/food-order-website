<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php
                    if(isset($_SESSION['login'])){ // If session variable has message in it
                        echo $_SESSION['login']; // Display message
                        unset($_SESSION['login']); // Remove message display on page refresh
                    }

                    if(isset($_SESSION['login-bypass-attempt'])) {
                        echo $_SESSION['login-bypass-attempt'];
                        unset($_SESSION['login-bypass-attempt']);
                    }
                ?>

                <br>

                <!-- Login Form Starts Here -->
                <form action="" method="post" class="text-center">
                    Username: <br>
                    <input type="text" name="username" placeholder="Enter Username"><br><br>
                    Password: <br>
                    <input type="password" name="password" placeholder="Enter Password"><br><br>
                    <input type="submit" name="login" value="Login" class="btn-primary"><br><br><br>
                </form>
                <!-- Login Form Endss Here -->

            <p class="text-center">Created by <a href="www.bitwilder.com">BitWilderInc</a></p>
        </div>
    </body>
</html>

<?php 
    // Check whether the submit button is clicked
    if(isset($_POST['login'])) {
        // Get form data
        $raw_username = $_POST['username'];
        $raw_password = md5($_POST['password']);

        $username = mysqli_real_escape_string($conn, $raw_username);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // Create SQL query for getting username and password from DB
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ;";

        // Execute SQL statement
        $res = mysqli_query($conn, $sql);

        // Check that there is exactly 1 user with said username and password
        // Count rows in result variable $res
        $count = mysqli_num_rows($res);
        if($count==1) {
            // User authenticated successfully
            // Save success session message and redirect user to landing page
            $_SESSION['login'] = "<div class='success'>Welcome ".$username.". You're Logged In.</div>";
            // User Session variable checks whether a user is logged in or not. It basically Implies the start of a User Session.
            // During logout this variable is unset by session_destroy() on logout page. That implies the end of the session of user of set username.
            $_SESSION['user'] = $username; 

            header('location:'.SITEURL.'admin/');
        } else {
            // If user not in database retain user on login page and save error session message
            $_SESSION['login'] = "<div class='error text-center'>Wrong Username or Password</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>
