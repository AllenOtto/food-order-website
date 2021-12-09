<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1><br><br>

                <?php 
                // Get the ID of the admin to be updated on manage-admin.pho
                $id = $_GET['id'];

                // Create SQL Query to UPDATE the admin row selected
                $sql = "SELECT * FROM tbl_admin WHERE id=$id;";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Get result as an aasociative array
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
                $password = $row['password'];

            ?>

            <!-- Update form with content to be updated loaded from DB -->
            <form action="" method="post">

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
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter Your Password" value="<?php echo $password; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                    </tr>
                </table>

            </form>

        </div>
    </div>

<?php include('partials/footer.php'); ?>