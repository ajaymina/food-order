<?php include('partials/menu.php'); ?>

<?php
//Check whether id is set or not
if (isset($_GET['id'])) {
    //Get all the data
    $id = $_GET['id'];

    //SQL Query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value based on query executed
    $row = mysqli_fetch_assoc($res2);

    //Get the individual values of selected food
    $title = $row['title'];
    $description = $row['description'];
    $price = $row['price'];
    $current_image = $row['image_name'];
    $current_category = $row['category_id'];
    $featured = $row['featured'];
    $active = $row['active'];
} else {
    //redirect to manage food
    header('location:' . SITEURL . 'admin/food.php');
}
?>

<div class="main">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="3"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>price: </td>
                    <td>
                        <input type="number" name="price" value=<?php echo $price; ?>>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            echo "<div class ='error'>Image not added.<div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select new Image: </td>
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
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                            ?>

                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

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
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['$current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];
            

            if (isset($_FILES['image']['name'])) {
                //get the value from form 
                $image_name = $_FILES['image']['name'];
                if ($image_name!= "") {
        
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
                    $image_name = $current_image;
                    //set default value
        
                }
                // Update the food database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category_id',
                    featured = '$featured',
                    active = '$active'
                    Where id=$id
                ";
                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    //query Executed and food updated
                    $_SESSION['update'] = "<div class = 'success'>Food Updated Successfully.</div>";
                    header("location:" . SITEURL . 'admin/food.php');
                }
                else{
                    //Failed to update food
                    $_SESSION['update'] = "<div class = 'error'>Failed to Update Food.</div>";
                    header("location:" . SITEURL . 'admin/food.php');
                }
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>