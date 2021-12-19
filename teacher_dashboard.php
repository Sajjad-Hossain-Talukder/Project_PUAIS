<?php
    session_start();
    include("connection1.php");
    if ( isset($_SESSION['tid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');
    
    $tid = $_SESSION['tid'] ; 
    $q = mysqli_query($con,"select * from teacher where T_Id = '$tid'");
    $row = mysqli_fetch_assoc($q);
    $tname = $row['T_name'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <style>
        .intro {
            box-shadow : 2px 2px 5px gray;
        }
        .first{
            border-radius : 20px;
            box-shadow : 1px 1px 10px gray ; 
        }
        a{
            text-decoration : none ;
            color : black; 
        }
        .dv:hover{
            border : 1px solid black;
            border-radius : 10px;
            box-shadow : 1px 1px 5px gray;
        }
    </style>
    <title><?php echo $tname; ?> | Dashboard</title>
</head>

<body>

<div class="container p-3 mt-2 first">  
   <div class="row">
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
       
       <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
           <a href="teacher_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
       </div>
       <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
       <a href="teacher_dashboard.php" style="text-decoration:none; color :black; text-align:center">
           <h1>Premier University</h1>
           <h6>Center of Excellence for Quality Learning</h6>
       </a>
           
       </div>
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
   </div> 
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
        <div class="card intro mt-5">
            <div class="card-header"><h5 class="text-center">Academic Information</h5></div>
                 <div class="card-body text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 dv"> <br>
                                <i class="material-icons">supervisor_account</i><br>
                                <h5><a href="teacher_advisorship.php">Advisorship</a> </h5>  <br>
                            </div>
                            <div class="col-lg-6 dv"><br>
                                <i class="material-icons">dns</i><br>
                                <h5><a href="teacher_courses.php">My Courses</a></h5> <br>
                            </div>
                            <div class="col-lg-6 dv"><br>
                                <i class="material-icons">account_balance</i><br>
                                <h5><a href="teacher_enrollment.php">Student Enrollment</a></h5> <br>
                            </div>
                            <div class="col-lg-6 dv"><br>
                                <i class="material-icons">email</i><br>
                                <h5><a href="teacher_change_password.php">Change Password</a></h5><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="card">
                <div class="card-header text-center">
                   <h5>Personal Information</h5>
                </div>
                <div class="card-body text-center">
                    <img src="uploaded_images/<?php echo $row['image']; ?>" class="img-fluid  img-thumbnail rounded p-3 intro">
                    <hr>
                    <h4><?php echo $tname; ?></h4>
                    <h6><?php echo $row['designation']; ?></h6>
                    <h6><?php echo $row['dept']; ?></h6>
                    <h6>Email : <?php echo $row['email']; ?></h6>
                    <h6>Contact : +88<?php echo $row['contact']; ?></h6> <br>
                    <a href="#" class="btn btn-warning" style="width:80%;"> View Profile</a> <br><br>
                </div>
            </div>

        </div>

    </div>
</div>



<div class="text-center mt-5">
    <a href="teacher_dashboard.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
    <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>

    <!-- bootstrap js, jquery, popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    
</body>
</html>

