
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
                <h1>Pastries</h1><br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>Dishes</h1><br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>Deserts</h1><br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>Drinks</h1><br>
                 Categories
            </div>

            <div class="clearfix"></div>
        </div>
        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>        