<?php include('partials/menu.php'); ?>


<!--Main Content Section Starts--->
<div class="main">
    <div class=wrapper>
        <h1>Add category</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td> <input type="text" name="title" placeholder="category title" required></td>
                </tr>

                <!-- <tr>
                    <td>Image name:</td>
                    <td> <input type ="image" placeholder="category title"></td>
                </tr> -->
                <!-- <br>
                <br> -->
                <tr>
                    <td>Featured: </td>
                    <td> <input type="radio" name="featured" value="Yes">Yes</td>
                    <td> <input type="radio" name="featured" value="No">No</td>

                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td> <input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td> <input type="radio" name="active" value="Yes">Yes</td>
                    <td> <input type="radio" name="active" value="No">No</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //get the value from form
            $title = $_POST['title'];
            //for radio input type check whether button is selected or not
            if (isset($_POST['featured'])) {
                //get the value from form 
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
                //set default value
        
            }
            if (isset($_POST['active'])) {
                //get the value from form 
                $active = $_POST['active'];
            } else {
                $active = "No";
                //set default value
        
            }

            if (isset($_FILES['image']['name'])) {
                //get the value from form 
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check whether image is uploaded or not
                    //if image not uploaded then we will stop the process and redirrect the error message
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class ='error'>Failed to upload image.</div>";
                        header("location:" . SITEURL . 'admin/add-category.php');
                        die();
                    }
                } else {
                    $image = "";
                    //set default value
        
                }
            }

            $sql = "INSERT INTO tbl_category SET
                   title = '$title',
                   featured = '$featured',
                   active = '$active',
                   image_name = '$image_name'";
            $res = mysqli_query($conn, $sql) or die(mysqli_error());
            if ($res == true) {
                $_SESSION['add'] = "<div class ='success'>Category Added Successfully.</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
                //query executed
        
            } else {
                //failed to add category
                $_SESSION['add'] = "<div class ='error'>Added Category UnSuccessfully.</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');

            }

        }
        ?>
    </div>
</div>
<!--Main Content Section ends--->


<?php include('partials/footer.php') ?>