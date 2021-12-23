<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-50">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Add Title"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5">

                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price (KES)</td>
                    <td><input type="number" name="price" min="0" max="10000" step="5"></td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="submit" class="btn-secondary"></td>
                </tr>
            </table>

        </form>

        <?php

        // Check if submit button is clicked
        if(isset($_POST['submit'])) {
            // Get form data
        }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>