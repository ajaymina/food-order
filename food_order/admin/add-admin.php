<?php include('partials/menu.php'); ?>
<!--Menu Section ends--->


<!--Main Content Section Starts--->
<div class="main">

    <div class=wrapper>
        <h1>Add admin</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>

                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name" required>
                    </td>

                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user_name" placeholder="Your username" required></td>

                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your password" required></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-secondary">
                </tr>
            </table>
        </form>

    </div>
</div>
<!--Main Content Section ends--->

<?php include('partials/footer.php') ?>

<?php
//check the value from form  and save it in database
//check whether the button is clicked or not
if (isset($_POST['submit'])) {
    //Button clicked
    //  echo "Button Clicked";
    //get the data from form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    //Sql query to save data into database
    $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$user_name',
        password = '$password'
         ";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    if ($res == TRUE) {
        //  echo "Data inserted";
        //create seesion
        $_SESSION['add'] = "Admin Added successfully";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else
        // echo "Data not inserted";
        $_SESSION['add'] = "fail to add Admin ";
    //redirect page to manage admin
    header("location:" . SITEURL . 'admin/manage-admin.php');

}

?>