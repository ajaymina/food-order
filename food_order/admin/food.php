<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br><br>

        <!-- <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a> -->
        <a href="add-food.php" class="btn-primary">Add food</a>
       
        <br><br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
              <br>
        <table class="tbl-full">
            <tr>
                <th>SNo.</th>
                <th>Title</th>
                <th>Image name</th>
                <th>Price</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>
        
                
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_food";
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
                        $price = $rows['price'];
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
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class ='error'>Image not added.<div>";
                        }

                        ?>
                    <!-- <?php echo $image_name ?> -->
                </td>
                <td>
                    <?php echo $price ?>
                </td>
                <td>
                    <?php echo $featured ?>
                </td>
                <td>
                    <?php echo $active ?>
                </td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id= <?php echo $id; ?>"
                        class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id= <?php echo $id; ?> "
                        class="btn-danger">Delete Food</a>
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

<?php include('partials/footer.php'); ?>

