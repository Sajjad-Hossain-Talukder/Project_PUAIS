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

if ( isset($_POST['remove']) ){
    $cc = $_GET['code'] ;  
    $sid = $_SESSION['sid'];
    $sec = $_POST['sec'];
    $sess = $_POST['sess'];
    $que = "delete from enrolled_courses where course_code = '$cc' and S_Id = '$sid' and flag='0' and section = '$sec' and  session_year = '$sess'" ;
    mysqli_query($con,$que);
}
$total = 0 ;
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
    <title>Pending Courses</title>
</head>

<body>

<div class="container p-3 mt-2 first">
   
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
    <div class="col-lg-12 col-md-8 cl-sm-6" >
        <h2 class="text-center my-5">Pending Courses</h2>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>   
                        <th >Semester</th>
                        <th >Course Code</th>
                        <th >Course Title</th>
                        <th >Section</th>
                        <th >Type</th>
                        <th >Credit</th>
                        <th >Course Fees</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        $sid = $_SESSION['sid'] ;
                        $qr = "select * from courses,enrolled_courses where flag = '0' and S_Id = '$sid' and courses.course_code = enrolled_courses.course_code";
                        $allrow = mysqli_query($con,$qr);
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
                        <td><?php 
                            $val = mysqli_query($con,"select * from courses where course_code = '$co_co'");
                            $val1 = mysqli_fetch_assoc($val);
                            $v = $val1['credit'];
                            echo $v; 
                        ?>
                        </td>   
                        <td><?php 
                            if( $ct == "Retake" ) $fees = 1000 ; 
                            else $fees = $v * 1800 ; 
                           
                            $total = $total + $fees ; 
                            echo   $fees. " Taka "; ?></td>      
                        <td>
                            <form method="post" action="student_pending_enrolled_courses.php?code=<?=$row['course_code']?>" > 
                            <input type="hidden" name="sec" value="<?=$row['section']?>">
                            <input type="hidden" name="sess" value="<?=$row['session_year']?>">
                            <input type="submit" name="remove" value="Remove" class="btn btn-outline-dark">
                            </form>            
                        </td>                     
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
    </div>
</div>

<div class="text-center mt-5">
    <a href="student_pending_enrolled_courses.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>
<div class="text-center py-3 mt-5 bg-dark text-white">
    <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>


</body>

</html>


                