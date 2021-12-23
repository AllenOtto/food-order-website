<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1><br>
            
            <?php

            if(isset($_SESSION['add-food'])) { // If session message is not null
                echo $_SESSION['add-food']; // Display session message
                unset($_SESSION['add-food']); // Remove session message on page refresh
            }

            ?>
            
            <br><br>
            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>Serial #</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Allen Moturi</td>
                    <td>AllenO</td>
                    <td><a href="#" class="btn-secondary">Edit Details</a> <a href="#" class="btn-danger">Delete Admin</a></td>
                </tr>
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>