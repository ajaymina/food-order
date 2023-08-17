<?php
    include('../config/constants.php');
     //1. get the ID  of admin to be deleted
    $id = $_GET['id'];
     //2.Create SQL Query to delete admin
     $sql = "DELETE FROM tbl_admin where id = $id";

     $res = mysqli_query($conn,$sql);

     if($res==TRUE){
        $_SESSION['delete'] = "Admin Deleted successfully";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
     }
     else{
        //echo "Admin not deleted";
        $_SESSION['delete'] = "Admin Deleted unsuccessfully";
        //redirect page to manage admin
      //  header('localhost:'. SITEURL . 'admin/manage-admin.php');
   
     }
     //3. Redirect to manage admin page with messsage
?>
