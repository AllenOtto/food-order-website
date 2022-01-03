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
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <?php
                        // Check whether id for food item ordered has been passed
                        if(isset($_GET['id'])) {
                            // Save food item id
                            $id = $_GET['id'];
                            // Create sql query to get food ordered from database
                            $sql = "SELECT title, price, image_name FROM tbl_food WHERE id=$id; ";
                            // Execute query
                            $res = mysqli_query($conn, $sql);
                            // Get row count
                            $count = mysqli_num_rows($res);
                            if($count==1) {
                                // Get food in an associative array
                                $row = mysqli_fetch_assoc($res);
                                // Get data items
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];

                                ?>

                                <div class="food-menu-img">
                                    <?php

                                    if($image_name != "") {
                                        ?>
                                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    } else {
                                        echo "<div class='error'>Image Unvailable</div>";
                                    }

                                    ?>
                                </div>
                
                                <div class="food-menu-desc">
                                    <h3><?php echo $title; ?></h3>
                                    <p class="food-price">KES <?php echo $price; ?></p>

                                    <div class="order-label">Quantity</div>
                                    <input type="number" name="qty" class="input-responsive" min='1' value="1" required>
                                    
                                </div>

                                <?php

                            } else {
                                // If there is no food result, the user didn't get here by clicking food item
                                // Clicking food item would have given him an id and so there would be a result
                                // So out with him
                                header('location'.SITEURL);
                            }

                            
                        } else {
                            header('location:'.SITEURL);
                        }
                    ?>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Allen Otto" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@allenotto.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

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
            <p>All rights reserved. Designed By <a href="https://github.com/AllenOtto">BitWilderInc</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>