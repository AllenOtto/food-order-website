<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1><br><br>

            
            <br>
            <form action="" method="post" enctype='multipart/form-data'>
                <table>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value=""></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description"cols="30" rows="5" value=""></textarea></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value=""></td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td><img src="" name="current_image" width="100px"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php'); ?>