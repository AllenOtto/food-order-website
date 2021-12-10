<?php include('../config/constants.php'); ?>

                

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>

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
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Create SQL query for getting username and password from DB
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ;";

        // Execute SQL statement
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Check that there is exactly 1 user with said username and password
        // Count rows in result variable $res
        $count = mysqli_num_rows($res);
        if($count==1) {
            // User authenticated successfully
            // Save success session message and redirect user to landing page
            $_SESSION['login'] = "<div class='success'>Welcome ".$username."</div>";
            header('location:'.SITEURL.'admin/index.php');
        } else {
            // If user not in database retain user on login page and save error session message
            $_SESSION['login'] = "<div class='error text-center'>Wrong Username or Password</div><br>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>
