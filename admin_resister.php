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
                        <div class="card-title text-center"><h2>Admin Resister</h2></div>
                    </div> 
                    <div class="card-body">
                        <div style="margin-left:15%; font-size:20px;">
                        <form method="post" enctype="multipart/form-data" >
                            <label for="aid"> Admin ID   </label> <br>
                            <input type="text" name ="aid" required  style="width:82%;"><br><br>

                            <label for="aname"> Admin Name   </label><br>
                            <input type="text" name ="aname" required  style="width:82%;"><br><br>

                            <label for="desig"> Designation   </label><br>
                            <input type="text" name ="desig" required style="width:82%;"><br><br>


                            <label for="email"> Email </label><br>
                            <input type="email" name="email" required  style="width:82%;"><br><br>

                            <label for="phone">Contact  </label><br>
                            <input type="tel" name="phone" required style="width:82%;"><br><br>

                            <label for="pass"> Password   </label><br>
                            <input type="password" name ="pass" required style="width:82%;"> <br><br>

                            <label for="cpass"> Confirm Password  </label><br>
                            <input type="password" name ="cpass" required style="width:82%;"> <br><br>

                            <label for="pic">Profile Image </label><br>
                            <input type="file" name="pic" required >
                            <br>
                            <br>
                            </div>
                            <div class="text-center">
                                <input type="submit" value="Resister" name="sub" class="btn-lg btn-outline-primary">
                            </div>
                            <br>
                            
                        </form>

                    </div>
                    <div class="card-footer text-center ">
                        <h6>Already Have Account ? <a href="admin_login.php" style="text-decoration:none;">Login</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

    <div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright ?? 2021 Premier University IT. All rights reserved.</h6>
    </div>

</body>
</html>


<?php
include("connection1.php");

if( isset($_POST['sub'])){

    $aid = $_POST['aid'];
    $aname = $_POST['aname'];
    $pass= $_POST['pass'];
    $desi= $_POST['desig'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];

    $ext = explode(".",$_FILES['pic']['name']);
    $c = count($ext);
    $ext = $ext[$c-1];
    $date = date("D:M:Y");
    $time = date("h:i:s");
    $image_name = md5($date.$time.$ext);
    $image = $image_name.".".$ext;

    $q = "insert into admin values ('$aid','$aname','$desi','$email','$contact','$pass','$image')";
   
    if ( mysqli_query($con,$q)  ){
        $image_Tname = $_FILES['pic']['tmp_name'];
        if($image != null ){
            move_uploaded_file($image_Tname,"uploaded_images/".$image);
        }
    }
    else echo"error!".mysqli_error($con);
}

?>



