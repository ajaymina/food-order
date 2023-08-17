<html>
    <head>
        <title>Food ordering website-Home</title>
        <link rel = "stylesheet" href="../css/admin.css">
    </head>


    <body> 
        <!--Menu Section Starts--->
        <?php include('partials/menu.php');?>
        <!--Menu Section ends--->


        <!--Main Content Section Starts--->
        <div class = "main">
        <div class = wrapper>
            <h1>Dashboard</h1>
            <br><br>
            <?php 
             if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
            <div class = "col-4 " >
                <h1>5</h1>
                <br></br>
                Categories
            </div>
            <div class = "col-4 " >
                <h1>5</h1>
                <br></br>
                Categories
            </div>
            <div class = "col-4 " >
                <h1>5</h1>
                <br></br>
                Categories
            </div>
            <div class = "col-4 " >
                <h1>5</h1>
                <br></br>
                Categories
            </div>
           <div class = clearfix></div>
        </div>
        </div>
        <!--Main Content Section ends--->


        <?php include('partials/footer.php') ?>
        
        
    </body>

</html>