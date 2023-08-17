<?php include('../config/constants.php'); ?>
<html>

<head>
    <title>LOGIN - FOOD ORDER</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <br><br>
        <?php 
             if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if (isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);

            }
        ?>
        <form action="" method="POST">
            Username: <br>
            <input type="text" name="username" placeholder="Enter name"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br>
        </form>
    </div>
</body>

</html>
<!-- <?php
if (isset($_POST['submit'])) {
    //Get data from login page
    echo $username = $_POST['username'];
    echo $password = $_POST['password'];
    //sql query to check whether the username and password exists or not 
    $sql = "SELECT * from tbl_admin WHERE username ='$username' AND password ='$password' ";
    $res = mysqli_query($conn, $sql);

    //count to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if($count==1){
       // $_SESSION['Login'] = "<div class ='success'>Login Succesfully.</div>;
        $_SESSION['user'] =$username;//to check whether the user login 
        header("location:".SITEURL.'admin/');
   
    }
    else if($count<1){
        // $_SESSION['Login'] = "<div class ="error">Login Unsuccesfully.</div>;
       
        header("location:".SITEURL.'admin/login.php');
    }
}


?> -->