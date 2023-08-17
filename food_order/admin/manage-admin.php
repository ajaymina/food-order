<?php include('partials/menu.php'); ?>
<!--Main Content Section Starts--->
<div class="main">
    <div class=wrapper>
        <h1>Manage admin</h1>

        <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <br />
        <br />
        <!-- Button to add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                //count row to check whether we have data in database or not
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        ?>
                        <tr>
                            <td>
                                <?php echo $sn++ ?>
                            </td>
                            <td>
                                <?php echo $full_name ?>
                            </td>
                            <td>
                                <?php echo $username ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id= <?php echo$id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id= <?php echo$id;?> " class="btn-danger">Delete Admin</a>
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
    </div>
</div>
<!--Main Content Section ends--->

<?php include('partials/footer.php') ?>