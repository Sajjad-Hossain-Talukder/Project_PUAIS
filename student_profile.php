<?php
    session_start();
    include('connection1.php');
    if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');

    date_default_timezone_set('Asia/Dhaka');
    $tdate= date("Y-m-d"); 
    $ttime = date("H:i:s"); 
    $today = date ("Y-m-d H:i:s");

    $sid = $_SESSION['sid']; 
    $r = mysqli_query($con,"select * from student where S_Id = '$sid'");
    $row = mysqli_fetch_assoc($r);

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
            color : black;
        }
    </style>
    <title><?php echo $row['S_name'];?> | Profile </title>
</head>

<body>

<div class="container p-3 mt-3 first">
   
   <div class="row">
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
       
       <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
           <a href="student_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
       </div>
       <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
       <a href="student_dashboard.php" style="text-decoration:none; color :black; text-align:center">
           <h1>Premier University</h1>
           <h6>Center of Excellence for Quality Learning</h6>
       </a>
           
       </div>
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
   </div> 
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2">
            <img src="uploaded_images/<?php echo $row['image'];?>" class="img-fluid rounded">
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <h6>Name </h6>
                                <h6>Father Name </h6>
                                <h6>Mother Name </h6>
                                <h6>Gender :</h6>
                                <h6>Date of Birth </h6>
                                <h6>Address </h6>
                            </div>
                            <div class="col-lg-6">
                                <h6>: <?php echo $row['S_name'];?> </h6>
                                <h6>: <?php echo $row['F_name'];?> </h6>
                                <h6>: <?php echo $row['M_name'];?> </h6>
                                <h6>: <?php echo $row['gender'];?> </h6>
                                <h6>: 
                                <?php 
                                    $date=date_create($row['dob']);
                                    echo date_format($date,"d F , Y ") ;
                                ?> 
                                </h6>
                                <h6>: <?php echo $row['address'];?> </h6>
                            </div>
                        </div>
                    </div>
                

                </div>
            </div>
        </div>
    </div>
</div>


<div class="text-center mt-5">
    <a href="student_courses.php?logout=log" class="btn-lg btn-danger">LogOut</a>
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

