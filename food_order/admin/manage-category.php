<?php include('partials/menu.php'); ?>


<!--Main Content Section Starts--->
<div class="main">
    <div class=wrapper>
        <h1>Manage category</h1>
        <br>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br>
        <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S No.</th>
                <th>Title</th>
                <th>Image name</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>
                
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                //count row to check whether we have data in database or not
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];

                        ?>
            <tr>
                <td>
                    <?php echo $sn++ ?>
                </td>
                <td>
                    <?php echo $title ?>
                </td>
                <td>
                <?php
                        if ($image_name != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class ='error'>Image not added.<div>";
                        }

                        ?>
                    <!-- <?php echo $image_name ?> -->
                </td>
                <td>
                    <?php echo $featured ?>
                </td>
                <td>
                    <?php echo $active ?>
                </td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id= <?php echo $id; ?>"
                        class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id= <?php echo $id; ?> "
                        class="btn-danger">Delete Category</a>
                </td>
            </tr>
            <tr>
                <?php

                    }
                } else {

                }
            }
            ?>
        </table>
        </form>

    </div>
</div>
<!--Main Content Section ends--->


<?php include('partials/footer.php') ?>