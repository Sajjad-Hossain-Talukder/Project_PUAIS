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
    $cc = $_GET['ccd'];
    $sec = $_GET['sec'];
    $sess = $_GET['sess'];
    $adate = $_GET['ada'];
    $atime = $_GET['ati'];
   

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
    <title>View Assignment?></title>
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

<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <?php 
                $q = mysqli_query($con,"select * from assignment where course_code ='$cc' and section = '$sec' and session_year = '$sess' and adate ='$adate' and atime = '$atime'");
                $row = mysqli_fetch_assoc($q);
            ?>
            <div class="card mt-5">
                <div class="card-header"><h4 class="text-center">Details</h4></div>
                <div class="card-body">
                    <h5>Title</h5>
                    <?php echo $row['title'];?> <br><br>
                    <h5>Details</h5>
                    <?php echo $row['detail'];?> <br><br>
                    <h5>Posted</h5>
                    <?php
                        $date=date_create($row['adate']);
                        $time =date_create($row['atime']);
                        echo date_format($date,"d F , Y ") ."  |  ". date_format($time,"h:i A");
                    ?> 
                    <br><br>
                    <h5>Due</h5>
                    <?php
                        $date=date_create($row['ddate']);
                        $time =date_create($row['dtime']);
                        echo date_format($date,"d F , Y ") ." |  ". date_format($time,"h:i A");
                    ?>       
                    
                </div>
            </div>

        </div>
        <div class="col-lg-3"></div>
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

