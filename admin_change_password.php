<?php
    session_start();
    include("connection1.php");
    if ( isset($_SESSION['aid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');
    
    $aid = $_SESSION['aid'];
    
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
        a{
            text-decoration : none ; 
        }
    </style>
    <title>Change Password</title>
</head>

<body>

<div class="container p-3 mt-2 first">
   
   <div class="row">
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
       
       <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
           <a href="admin_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
       </div>
       <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
       <a href="admin_dashboard.php" style="text-decoration:none; color :black; text-align:center">
           <h1>Premier University</h1>
           <h6>Center of Excellence for Quality Learning</h6>
       </a>
           
       </div>
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
   </div> 

</div>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="card text-center mt-5">
                <div class="card-header">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                            
                        <label for="old"> Old Password </label> <br>
                        <input type="text" name="old" style="width:80%;" required><br><br>
                        <?php
                            if(@$_GET['oldp'] == true ){
                                
                        ?>
                                <p class="text-center" style="color:red;">Old Password is Invalid!</p>
                        <?php
                            }
                        ?>

                        <label for="new"> New Password </label><br>
                        <input type="text" name="new" style="width:80%;" required><br><br>

                        <?php
                            if(@$_GET['invalid'] == true ){
                                
                        ?>
                                <p class="text-center" style="color:red;">New and Confirm did not Matched.</p>
                        <?php
                            }
                        ?>

                        <label for="confirm"> Confirm Password </label><br>
                        <input type="text" name="confirm" style="width:80%;" required><br><br>
                        <?php 

                        ?>

                        <input type="submit" name="sub" value="Change" class="btn btn-outline-danger" style="width:80%;">
                    </form>
                </div>
                <div class="card-footer">
                    <?php 
                        if(isset($_POST['sub'])){
                            $old = $_POST['old'];
                            $new = $_POST['new'];
                            $confirm = $_POST['confirm'];

                            if($new == $confirm ){
                                $q = mysqli_query($con,"select * from admin where A_Id = '$aid' and pass = '$old'");
                                if ( mysqli_fetch_assoc($q)){
                                    mysqli_query($con,"update admin set pass ='$new' where A_Id = '$aid' "); 
                            ?>
                                <h6 class="text-center"> Password Changed Successfully!!!</h6>
                            <?php
                                }
                                else {
                                    header("location:admin_change_password.php?oldp=dinvalid");
                                }
                            }
                            else {
                                header("location:admin_change_password.php?invalid=didnot_match");
                            }

                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>


<div class="text-center mt-5">
        <a href="admin_change_password.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>
<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    
</body>
</html>