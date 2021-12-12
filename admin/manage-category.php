<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Categories</h1><br>

            <?php
                if(isset($_SESSION['add-category'])) {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
            ?>
            
            <br>
            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a><br><br>

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
                <tr>
                    <td>2.</td>
                    <td>Wendy Moturi</td>
                    <td>WendyM</td>
                    <td><a href="#" class="btn-secondary">Edit Details</a> <a href="#" class="btn-danger">Delete Admin</a></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Wilder Moturi</td>
                    <td>WilderM</td>
                    <td><a href="#" class="btn-secondary">Edit Details</a> <a href="#" class="btn-danger">Delete Admin</a></td>
                </tr>
            </table>

            <div class="clearfix"></div>
        </div>        
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>