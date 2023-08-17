<?php
    if (!isset($_SESSION['user'])) {
        //Authorization-Access Control
        //user is not logged in 
        //redirect to login page with message

        $_SESSION['no-login-message'] ="<div>Please login to access Admin panel.</div>";
        //redirect to login page
        header("location:".SITEURL.'admin/login.php');
   
    }
 
?>