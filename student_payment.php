<?php
include("connection1.php");
session_start();

if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){   
    if( @$_GET['logout'] == true ){
        session_destroy();
        header('location:index.php');
    }
}
else header('location:index.php');
$sid = $_SESSION['sid'] ;
$t = mysqli_query($con,"select * from student where S_Id = '$sid'");
$er = mysqli_fetch_assoc($t);
$total = 0 ;

?>

<!DOCTYPE html>
<html lang="en">
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
    </style>
    <title>Payment | <?php echo $er['S_name'];?> </title>
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
    <div class="col-lg-12 col-md-8 cl-sm-6" >
        <h2 class="text-center mt-5">Payment</h2> <br>
        <?php 
            $qr = "select * from enrolled_courses,courses where flag = '100' and S_Id = '$sid' and enrolled_courses.course_code = courses.course_code order by sem_n";
            $allrow = mysqli_query($con,$qr);
            if (mysqli_fetch_assoc($allrow) ){
        ?>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>   
                        <th >Semester</th>
                        <th >Course Code</th>
                        <th >Course Name</th>
                        <th >Section</th>
                        <th >Type</th>
                        <th >Credit</th>
                        <th >Course Fees</th>
                    </tr>
                </thead>
                <tbody>

                   <?php
                        while( $row = mysqli_fetch_array($allrow)){
                            $co_co = $row['course_code'];
                            $ct = $row['type'];
                    ?>
                                        
                    <tr>
                        <td><?php echo $row['sem']; ?></td>
                        <td><?php echo $row['course_code']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>

                        <td><?php echo $row['section']; ?></td>
                        <td><?php echo $row['type']; ?></td>  
                        <td><?php echo $row['credit']; $v =$row['credit']; ?></td>   
                        <td><?php 
                            if( $ct == "Retake" ) $fees = 1000 ; 
                            else $fees = $v * 1800 ; 
                            $total = $total + $fees ; 
                            echo   $fees. " Taka "; ?></td>                           
                    </tr>
                    
                    <?php
                        }
                    ?>
                    <tr> 
                    <td colspan="6" style="color:red;">Total Tuition Fees</td>
                    <td> 
                        <?php
                        echo "= ".$total . " Taka " ; 
                        ?>
                    </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <?php
            }
            else {
        ?>
        <div class="text-center mt-5">
            <h5 class="btn btn-outline-dark">No Courses are not Enrolled Yet.</h5>
        </div>
        <?php
            }
        ?>
    </div class="mt-5">
</div>


<div class="text-center mt-5">
    <a href="student_courses.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>
<div class="text-center py-3 mt-5 bg-dark text-white">
    <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>


</body>

</html>


                