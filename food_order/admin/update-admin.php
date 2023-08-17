<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br />
        <br />

        <?php
        //1.Get the ID of selected Admin
        $id = $_GET['id'];

        //2. Create SQL Query to get the details
        $sql = "SELECT* FROM tbl_admin WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check wheather the query is executed or not
        if ($res == true) {
            // Check wheather the data is available or not
            $count = mysqli_num_rows($res);
            // Check
            if ($count == 1) {
                //Get the details
                // echo "Admin Available"; 
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //Redirect to Manager Admin Page
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>

                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" required>
                    </td>

                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type=" text" name="user_name" value="<?php echo $username; ?>" required></td>

                </tr>
                
                <tr>
                    <td colspan=" 2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-secondary">
                </tr>
                
        </form>

    </div>
</div>

<?php

//check wheather the submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "Button Clicked";
    //Get all the values from the update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];

    // Create a SQL Query to update Admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$user_name'
    WHERE id='$id';
    ";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether  the query executed successfully or not
    if ($res == TRUE) {
        //  Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Admin Update successfully";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else
        // Failed to update Admin;
        $_SESSION['update'] = "<div class='error'>failed to delete admin </div>";
    //redirect page to manage admin
    header("location:" . SITEURL . 'admin/manage-admin.php');
}

?>
<!--Footer Starts--->
