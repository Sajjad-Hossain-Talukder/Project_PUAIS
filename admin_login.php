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

    <title>Login-Admin</title>

</head>

<body >

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

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center"><h2>Admin Login</h2></div>
                    </div> 
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                        <div  style="margin-left:15%; font-size:20px;">
                            <?php
                                if(@$_GET['Empty'] == true ){
                            ?>
                                <p>Fill the Id and Password First</p>
                            <?php
                                }
                            ?>

                            <?php
                            if(@$_GET['invalid'] == true ){
                            ?>

                            <p style="margin-left:10%">Password or Admin Id is Wrong</p>

                            <?php
                            }
                            ?>

                            <label for="aid"> Admin ID   </label> <br>
                            <input type="text" name ="aid" required  style="width:82%;"><br><br>

                            <label for="pass"> Password   </label><br>
                            <input type="password" name ="pass" required  style="width:82%;"> <br> <br>



                            <input type="submit" value="lOG IN" name="sub" class="btn btn-primary" style="width:82%;"><br>
                        </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <h6>Need an Account ? <a href="admin_resister.php" style="text-decoration : none;">Resister</a> </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
    </div>
</body>
</html>


<?php
include("connection1.php");
session_start();

if( isset($_POST['sub'])){


    if ( empty($_POST['aid']) || empty($_POST['pass']) ){
       header("location:admin_login.php?Empty=teacherID and pass");
    }
    else {

        $sql = "select * from admin where A_Id = '".$_POST['aid']."' and pass = '".$_POST['pass']."'";
        $q = mysqli_query($con,$sql);

        if (mysqli_fetch_assoc($q)){

            $_SESSION['aid'] =$_POST['aid'] ;
            $_SESSION['logged_in_status'] = "loggedin";
            header('Location:admin_dashboard.php');

        }
        else {
            header("location:admin_login.php?invalid=id and password is invalid");
        }
    }

    
}
?>
