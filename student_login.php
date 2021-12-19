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

    <title>Login-Student</title>

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
                        <div class="card-title text-center"><h3>Student Login</h3></div>
                    </div> 
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                        <div class="text-center">
                            <?php
                            if(@$_GET['invalid'] == true ){
                            ?>
                                <p style="color : red;" class="text-center">Password or Id is invalid !</p>
                            <?php
                            }
                            ?>

                            <label for="sid"> Student ID   </label> <br>
                            <input type="text" name ="sid" required  style="width:82%;"><br><br>

                            <label for="pass"> Password   </label><br>
                            <input type="password" name ="pass" required  style="width:82%;"> <br> <br>



                            <input type="submit" value="lOG IN" name="sub" class="btn btn-primary" style="width:82%;"><br>
                        </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <h6>Need an Account ? <a href="student_resister.php" style="text-decoration : none;">Resister</a> </h6>
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


    if ( empty($_POST['sid']) || empty($_POST['pass']) ){
       header("location:student_login.php?Empty=StudentId and pass");
    }
    else {

        $sql = "select * from student where S_Id = '".$_POST['sid']."' and S_pass = '".$_POST['pass']."'";
        $q = mysqli_query($con,$sql);

        if (mysqli_fetch_assoc($q)){

            $_SESSION['sid'] =$_POST['sid'] ;
            $_SESSION['logged_in_status'] = "loggedin";
            header('Location:student_dashboard.php');

        }
        else {
            header("location:student_login.php?invalid=id and password is invalid");
        }
    }

    
}
?>
