
<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1><br><br>

            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login']; // Show successful login message
                    unset($_SESSION['login']); // Remove session message on page refresh
                }
            ?>
            <br><br>
            <div class="col-4 text-center">
                <?php
                    // Display total number of categories of foods available
                    // Create sql to get all categories from database
                    $sql = "SELECT * FROM tbl_category";
                    // exeute query
                    $res = mysqli_query($conn, $sql);
                    // Get number of rows
                    $count = mysqli_num_rows($res); // This is our number of categories
                    
                ?>
                <h1><?php echo $count; ?></h1><br>
                Categories
            </div>

            <div class="col-4 text-center">
                <?php
                    // Display total number of categories of foods available
                    // Create sql to get all categories from database
                    $sql2 = "SELECT * FROM tbl_food";
                    // exeute query
                    $res2 = mysqli_query($conn, $sql2);
                    // Get number of rows
                    $count2 = mysqli_num_rows($res2); // This is our number of categories
                    
                ?>
                <h1><?php echo $count2; ?></h1><br>
                Foods
            </div>

            <div class="col-4 text-center">
                <?php
                    // Display total number of categories of foods available
                    // Create sql to get all categories from database
                    $sql3 = "SELECT * FROM tbl_order";
                    // exeute query
                    $res3 = mysqli_query($conn, $sql3);
                    // Get number of rows
                    $count3 = mysqli_num_rows($res3); // This is our number of categories
                    
                ?>
                <h1><?php echo $count3; ?></h1><br>
                Total Orders
            </div>

            <div class="col-4 text-center">

                <?php
                    // Create sql query to get total revenue generated
                    // Use the SUM() sql function
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'; ";
                    // Execute query
                    $res4 = mysqli_query($conn, $sql4);
                    // Get the value
                    $row4 = mysqli_fetch_assoc($res4);
                    // Retrieve total from our row result
                    $total_revenue = $row4['Total'];


                ?>


                <h1>Ksh <?php echo $total_revenue; ?></h1><br>
                 Revenue Generated
            </div>

            <div class="clearfix"></div>
        </div>
        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>        