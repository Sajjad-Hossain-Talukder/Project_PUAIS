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
    $sess= $_POST['sess'];
    $que = "delete from enrolled_courses where course_code = '$cc' and S_Id = '$sid' and flag='0' and section = '$sec' and session_year = '$sess'"  ;
    mysqli_query($con,$que);
}

if ( isset($_POST['enroll'])){

    $cc = $_GET['cc'] ;  
    $sid = $_SESSION['sid'];
    $sess =  $_POST['sess'] ;  
    $type = $_POST['enroll_type'] ;
    $section =  $_POST['section'];

    $q = "select * from enrolled_courses where S_Id = '$sid' and  course_code = '$cc' ";
    $row = mysqli_query($con,$q);

    if (mysqli_fetch_assoc($row)){
        
    }
    else {
        mysqli_query($con,"insert into enrolled_courses values('$sid','$cc','$section','$sess','$type' , '0')");
    }
}

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
    <title>Enrollment</title>
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
        <div class="row">
            <div class="col-md-8">
                <h2 class="text-center">Courses </h2>
                    <div class="row">
                        <?php
                            $sql = "select * from offered_courses , courses where courses.course_code = offered_courses.course_code " ; 
                            $q = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($q)){
                        ?>
                        <div class="col-md-4">
                            <form method="post" action="student_enrollment.php?cc=<?=$row['course_code']?>" > 
                                <div class="card mt-5" >
                                    <img class="card-img-top img-fluid" src="uploaded_images/<?=$row['image']?>" alt="Card image cap">
                                    <div class="card-body text-center">
                                        <div style="height:100px;">   
                                            <h5 class="card-title"  > <?=$row['course_name']?> </h5>
                                            <h6 class="card-text text-enter" ><?=$row['course_code']?></h6>   
                                        </div>
                                            
                                        <hr>
                                            
                                        <h6 class="card-text" >Semester : <?=$row['sem']?></h6>
                                        <h6 class="card-text" >Section : <?=$row['section']?></h6>
                                        <h6 class="card-text" >Credits : <?=$row['credit']?></h6>
                                            
                                        <h6 class="card-text" >Course Type </h6>
                                        <h6>
                                            <select name="enroll_type" id="enroll_type" class="form-control text-center">
                                                <option value="Regular">Regular</option>
                                                <option value="Retake">Retake</option>
                                                <option value="Recourse">Recourse</option>
                                               
                                            </select>
                                        </h6>

                                        <input type="hidden" name="c_code" value="<?=$row['course_code']?>">
                                        <input type="hidden" name="sid" value="<?=$_SESSION['sid']?>">
                                        <input type="hidden" name="section" value="<?=$row['section']?>">
                                        <input type="hidden" name="sess" value="<?=$row['session_year']?>">
                                           
                                              
                                           
                                   
                                    </div>
                                    <div class="card-footer">
                                        <p class="text-center"><input type="submit" class="btn btn-primary btn-block my-2" name="enroll" value="Enroll Course"></p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php        
                            }
                        ?>
                    </div>
            </div>

            <div class="col-md-4">
                <h2 class="text-center mb-5">Enrolled Courses</h2> 
                 <table class="table text-center">
                    <thead>
                        <tr>
                            <th >Course Title</th>
                            <th >Section</th>
                            <th >Type</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sid = $_SESSION['sid'] ;
                            $qr = "select * from enrolled_courses,courses where flag = '0' and S_Id = '$sid' and enrolled_courses.course_code = courses.course_code ";
                            $allrow = mysqli_query($con,$qr);
                            while( $rw = mysqli_fetch_array($allrow)){
                        ?>
                                        
                        <tr>
                            <td><?php echo $rw['course_name']; ?></td>
                            <td><?php echo $rw['section']; ?></td>
                            <td><?php echo $rw['type']; ?></td>
                            <td>
                               
                                <form method="post" action="student_enrollment.php?code=<?=$rw['course_code']?>" > 
                                    <input type="hidden" name="sec" value="<?=$rw['section']?>">
                                    <input type="hidden" name="sess" value="<?=$rw['session_year']?>">
                                    <input type="submit" name="remove" value="Remove" class="btn btn-danger">
                                </form>
                                
                            </td>
                                            
                        </tr>

                        <?php
                            }
                        ?>

                                
                                
                    </tbody>
                </table>
                <?php 
                    $n = mysqli_query($con,"select * from enrolled_courses where flag = '0' and S_Id = '$sid'"); 
                    if( mysqli_fetch_assoc($n)){
                ?>
                <div>
                    <a href="student_pending_enrolled_courses.php" class="btn btn-success btn-lg btn-block" style="width:100%;" >Confirm</a>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>

            
 
    

<div class="text-center mt-5">
        <a href="student_enrollment.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>
<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>

</body>

</html>

