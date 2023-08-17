<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="3" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //Create php code to display from data base
                            // 1. Create SQL to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count rows to check wheather we have category or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero , we have category else we do not have categories
                            if ($count > 0) {
                                //we have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                // we do not have category
                                ?>
                                <option value="0">No category Found</option>
                            <?php
                            }

                            //2. Display on Dropdown

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">yes
                        <input type="radio" name="featured" value="No">no
                    </td>
                </tr>

                <tr>
                    <td>active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">yes
                        <input type="radio" name="active" value="No">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        //check whether the botton is clicked or not
        if (isset($_POST['submit'])) {
            //add the food in the database
            // echo "clicked";
                
            //1. get the data from form 
            $title = mysqli_real_escape_string($conn,$_POST['title']);;
            $description = mysqli_real_escape_string($conn,$_POST['description']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);;
            $category = mysqli_real_escape_string($conn,$_POST['category']);

            //check whether radio button for featured and active are checked or not
            if (isset($_POST['featured'])) {
                //get the value from form 
                $featured = mysqli_real_escape_string($conn,$_POST['featured']);
            } else {
                $featured = "No";
                //set default value

            }
            if (isset($_POST['active'])) {
                //get the value from form 
                $active =  mysqli_real_escape_string($conn,$_POST['active']);
            } else {
                $active = "No";
                //set default value

            }

            //2. upload the image if selected
            if (isset($_FILES['image']['name'])) {
                //get the value from form 
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check whether image is uploaded or not
                    //if image not uploaded then we will stop the process and redirrect the error message
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class ='error'>Failed to upload image.</div>";
                        header("location:" . SITEURL . 'admin/food.php');
                        die();
                    }
                } else {
                    $image_name = "";
                    //set default value
        
                }
            }
           
            //3. Insert into database
          
            $sql = "
                 INSERT INTO tbl_food 
                 (title,description,price,image_name,category_id,featured,active) 
                 VALUES ('$title', '$description', '$price', '$image_name' , '$category', '$featured','$active')";
                
                $res = mysqli_query($conn, $sql) or die(mysqli_error());
                
                
            //check whether the data is inserted or not
            //4. Redirct with message to manage food page
            if ($res == true) {
                //$_SESSION['add'] = "<div class ='success'>Food Added Successfully.</div>";
                header("location:" . SITEURL . 'admin/food.php');
                //query executed

            } else {
                //failed to add category
                //$_SESSION['add'] = "<div class ='error'>Failed to add Food.</div>";
                header("location:" . SITEURL . 'admin/food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>