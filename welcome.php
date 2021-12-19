

<?php

    session_start();

    if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <style>
        .first{
            border-radius : 20px;
            box-shadow : 1px 1px 10px gray ; 
        }
    </style>

    <title>Resister-Admin</title>

</head>

<body>

    <div class="container p-3 mt-5 first">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-12"></div>
            <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
                <a href="index.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
                <a href="index.php" style="text-decoration:none; color : black; text-align:center">
                    <h1>Premier University</h1>
                    <h6>Center of Excellence for Quality Learning</h6>
                </a>
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12"></div>
        </div> 
    </div>

    <div class="text-center">
        Successfully Resistered 
        Welcome . 
        Login
    </div>






</body>
</html>

