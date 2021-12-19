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
    $aid =  $_SESSION['aid'];

    $qr = mysqli_query($con,"select * from admin where A_Id = '$aid'");

    while( $row = mysqli_fetch_assoc($qr)){
        $aname = $row['A_name'];
        $desi = $row['designation'];
        $email = $row['email'];
        $contact = $row['contact'];
        $image = $row['image'];
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
    <title>Admin Dashboard</title>
</head>

<body>

<div class="container p-3 mt-2 first">
   
   <div class="row">
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
       
       <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
           <a href="admin_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
       </div>
       <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
       <a href="admin_dashboard.php" style="text-decoration:none; color : black; text-align:center">
           <h1>Premier University</h1>
           <h6>Center of Excellence for Quality Learning</h6>
       </a>
           
       </div>
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
   </div> 

</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Academic Info</h4>
                </div>
                <div class="card-body text-center">
                <div class="row">
                <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="student_resister.php" class="stretched-link text-dark"> <h4>Student Resister</h4> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="teacher_resister.php" class="stretched-link text-dark"> <h4>Teacher Resister</h4> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="admin_advisor_assign.php" class="stretched-link text-dark"> <h4>Advisor Assign</h4> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="admin_all_session.php" class="stretched-link text-dark"><h4>Adding Session</h4></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">   
                            <div class="card-body bg-light">
                                <a href="admin_insert_courses.php" class="stretched-link text-dark" ><h4>Adding Courses</h4></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="admin_offer_courses.php" class="stretched-link text-dark"><h4>Offer Courses</h4></a>  
                            </div>
                        </div>           
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="admin_all_courses.php" class="stretched-link text-dark"><h4>All Courses</h4></a>  
                            </div>
                        </div>  
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4>Student Details</h4> </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4>Teacher Details</h4> </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4> Results</h4> </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4> Payment </h4> </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4> Exam Schedule</h4> </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4>Class Routine</h4> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="#" class="stretched-link text-dark"> <h4> Notices</h4> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="card my-3" >
                            <img src="uploaded_images/course_image.png" class="card-img-top">
                            <div class="card-body bg-light">
                                <a href="admin_change_password.php" class="stretched-link text-dark"> <h4> Change Password</h4> </a>
                            </div>
                        </div>
                    </div>
                   

                </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-4">

           

            <div class="card">
                <div class="card-header text-center">
                    <h4>Personal Info</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="uploaded_images/<?php echo $image;?>" class="img-fluid"> <hr><br>
                        <h3><?php echo $aname;?></h3>
                        <h6><?php echo $desi;?></h6>
                        <h6><?php echo $email;?></h6>
                        <h6><?php echo $contact;?></h6>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-warning" style="width:100%;">Edit Info</a>
                </div>
            </div>
        </div>
    </div>
</div>



   
<div class="text-center mt-5">
    <a href="admin_dashboard.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       

</body>

</html>