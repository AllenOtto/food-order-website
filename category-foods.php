<?php include('config/constants.php'); ?>

<?php
    if(isset($_GET['category_id'])) {
        // Get category id passed via url
        $category_id = $_GET['category_id'];
        // Create sql query to get title of row where id=$category_id
        $sql_title = "SELECT title FROM tbl_category WHERE id=$category_id";
        // execute query
        $res_title = mysqli_query($conn, $sql_title);
        // Get row count
        $count_title = mysqli_num_rows($res_title);
        // Check if we have title result
        if($count_title > 0) {
            // Get result in an associative array
            $row_title = mysqli_fetch_assoc($res_title);
            // Get title
            $category_title = $row_title['title'];

        } else {
            echo "<div class='error'>No Categories in Database</div>";
        }
    } else {
        header('location:'.SITEURL);
    }
?>

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
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // Create sql query to get all food in chosen category
            $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id; ";
            // Execute query
            $res = mysqli_query($conn, $sql);
            // Get row count
            $count = mysqli_num_rows($res);
            // Check if we have food in category or not
            if($count>0) {
                // Get food in associative array while it's available
                while($row=mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $price = $row['price'];
                    $description = $row['description'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image_name != "") {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                } else{
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">KES <?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>No Food Available Yet</div>";
            }

            ?>

            <div class="clearfix"></div>

        </div>

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
            <p>All rights reserved. Designed By <a href="https://github.com/AllenOtto">BitWilderInc</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>