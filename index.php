<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Write sql query to get categories of foods
                $sql = "SELECT * FROM tbl_category WHERE  featured='Yes' AND active='Yes' LIMIT 3";
                // Execute query
                $res = mysqli_query($conn, $sql);
                // Get row count
                $count = mysqli_num_rows($res);
                // Check if we have foods or not
                if($count>0) {
                    // There are categories of foods. Fetch them in an associative array
                    while($row=mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $image_name = $row['image_name'];
                        $title = $row['title'];

                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name != "") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                        <?php
                    }
                    
                } else {
                    // If count less than 0 there are no categories in db hence no associated foods
                    echo "<div class='error'>Image Not Available</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                // Display the array of food on the menu
                // Create an sql query to get all food that is both active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6; ";
                // execute query
                $res2 = mysqli_query($conn, $sql2);
                // Get row count
                $count2 = mysqli_num_rows($res2);
                // Check if there are food items or not
                if($count2 > 0) {
                    // Get food items in an associative array while there are still rows in the database
                    while($row2=mysqli_fetch_assoc($res2)) {
                        // Get data for individual food items
                        $id2 = $row2['id'];
                        $title2= $row2['title'];
                        $price2 = $row2['price'];
                        $image_name2 = $row2['image_name'];
                        $description2 = $row2['description'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name2 != "") {
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name2; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    } else {
                                        echo "<div class='error'>No Image Available</div>";
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title2; ?></h4>
                                <p class="food-price">KES <?php echo $price2; ?></p>
                                <p class="food-detail">
                                    <?php echo $description2; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php

                    }
                } else {
                    echo "<div class='error'>No Food Items in Database</div>";
                }

            ?>

            

            
            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">BitWilderInc</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>