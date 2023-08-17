<?php
    include('../config/constants.php');
     //1. get the ID  of category to be deleted
     $id = $_GET['id'];
     //2.Create SQL Query to delete category
     $sql = "DELETE FROM tbl_category where id= $id";

     $res = mysqli_query($conn,$sql);

     if($res==TRUE){
        $_SESSION['delete'] = "<div class ='success'>Category Deleted successfully</div>";
        //redirect page to manage category
        header("location:".SITEURL.'admin/manage-category.php');
     }
     else{
        //echo "Category not deleted";
        $_SESSION['delete'] = "Category Deleted unsuccessfully";
        //redirect page to manage category
      //  header('localhost:'. SITEURL . 'admin/manage-category.php');
   
     }
     //3. Redirect to manage admin page with messsage
?>

<?php include('partials/footer.php') ?>