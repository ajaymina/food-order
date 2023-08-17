<?php include('partials/menu.php'); ?>
<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br />
        <br />


        <?php
        //1.Get the ID of selected Admin
        $id = $_GET['id'];

        //2. Create SQL Query to get the details
        $sql = "SELECT * FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                
                $id = $row['id'];

                $title = $row['title'];
                $featured = $row['featured'];
                $active = $row['active'];
                $current_image = $row['image_name'];

            } else {
                //Redirect to Manager Admin Page
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                  </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class ='error'>Image not added.<div>";
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image" value="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td> <input type="radio" name="featured" value="Yes">Yes</td>
                    <td> <input type="radio" name="featured" value="No">No</td>

                </tr>
                <tr>
                    <td>Active:</td>
                    <td> <input type="radio" name="active" value="Yes">Yes</td>
                    <td> <input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        //<input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
   
    $title = $_POST['title'];
   $current_image = $_POST['$current_image'];
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
    //updating the image
    //check whether the image is selected or not
    if (isset($_FILES['image']['name'])) {
        //get the value from form 
        $image_name = $_FILES['image']['name'];
        if ($image_name!= "") {

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/category/" . $image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
            //check whether image is uploaded or not
            //if image not uploaded then we will stop the process and redirrect the error message
            if ($upload == false) {
                $_SESSION['upload'] = "<div class ='error'>Failed to upload image.</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
                die();
            }
        } else {
            $image_name = $current_image;
            //set default value

        }}
   // $new_image = $_POST['$new_image'];
    // 




    $sql = "UPDATE tbl_category SET
     title ='$title',
     featured ='$featured',
     active ='$active',
     image_name ='$image_name'
        WHERE id = '$id'
        ";
   
   $res2 = mysqli_query($conn, $sql);

    //Check whether  the query executed successfully or not
    if ($res2 == TRUE) {
        //  Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Category Update successfully";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else{
        // Failed to update Admin;
        $_SESSION['update'] = "<div class='error'>failed to delete category </div>";
    //redirect page to manage admin
    header("location:" . SITEURL . 'admin/manage-category.php');
}

}
?>
<?php include('partials/footer.php') ?>