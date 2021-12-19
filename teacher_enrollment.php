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

    $src =  $_GET['sid'];    
    $val = mysqli_query($con,"select * from student where S_Id = '$src'"); 
    $dat =  mysqli_fetch_assoc($val);

    if( isset($_POST['accept'])){
        $cc = $_POST['course_code'] ;
        $sec = $_POST['section'];
        $qry = mysqli_query($con,"update enrolled_courses set flag='100' where S_Id = '$src' and course_code = '$cc' and section = '$sec' and flag='0'");
    }
    if( isset($_POST['drop'])){
        $cc = $_POST['course_code'] ;
        $sec = $_POST['section'];
        $qry = mysqli_query($con,"update enrolled_courses set flag='-100' where S_Id = '$src' and course_code = '$cc' and section = '$sec'");
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
    <title><?php echo $dat['S_name'];?> | Profile </title>
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
            <div class="col-lg-2 col-sm-12">
                <div class="card mt-5">
                    <img class="card-img-top img-fluid" src="uploaded_images/<?=$dat['image']?>">
                </div>
            </div>
            <div class="col-lg-7 col-sm-12">
                <div class="card mt-5 text-center">     
                    <div class="card-header">
                        <h4>Basic Info</h4>
                    </div>
                    <div class="card-body">
                        <h4><?php echo $dat['S_name']; ?></h4>
                        <h6>ID : <?php echo $dat['S_Id']; ?></h6>
                        <h6><?php echo $dat['dept']; ?></h6>
                        <h6>Email :<?php echo $dat['email']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="card mt-5 text-center">               
                    <div class="card-header">
                        <h4>Contact</h4>
                    </div>
                    <div class="card-body">
                        <h6>Short Note (1500) </h6>
                        <form method = "post">
                            <textarea rows = "5" cols = "25" name = "msg"></textarea><br>
                            <input type="hidden" name="sid" value="<?=$dat['S_Id']?>">
                            <input type = "submit" value = "Send Message" name="subm" class="btn btn-outline-dark my-2"  style="width:80%;"/>
                        </form>
                        <h6>OR</h6>
                            <a href="mailto:<?php echo $dat['email']; ?>" class="btn btn-outline-dark"  style="width:80%;">Send Email</a><br>                              
                    </div>
                </div>
            </div>
        </div>                  
</div>

<?php 
    if(isset($_POST['subm'])){
        $sid = $_POST['sid']; ; 
        $msg = $_POST['msg'];
        $tid = $_SESSION['tid'];
        mysqli_query($con,"insert into message(sby,rby,seen,message) values('$tid','$sid','0','$msg')");
    }
?>

<div class="container">
        <main>
            <div class="other-section">
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#pc"> <h6>Pending Courses</h6> </a></li>
                    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#rc"><h6>Running Courses </h6></a></li>
                    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#cc"><h6>Completed Courses</h6></a></li>
                    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#mk"><h6>Marks</h6></a></li>

                </ul>

                <div class="tab-content">
                    <div id="pc" class="tab-pane active">
                        <div class="container text-center">
                            <?php
                                $qy = mysqli_query($con,"select * from enrolled_courses where S_Id = '$src' and flag = '0' ");
                                if(mysqli_fetch_assoc($qy)){
                            ?>
                            <h4 class="mt-5">Pending Courses</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive mt-5">
                                        <table class="table">
                                            <thead>
                                                <th>Semester</th>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Section</th> 
                                                <th>Type</th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php   
                                                    $qry = mysqli_query($con,"select * from enrolled_courses,courses where enrolled_courses.course_code = courses.course_code and S_Id = '$src' and flag = '0'");
                                                    while($row = mysqli_fetch_array($qry)){
                                                ?>
                                            
                                                <tr>
                                                    <td><?php echo $row['sem']; ?></td>
                                                    <td><?php echo $row['course_code']; ?></td>
                                                    <td><?php echo $row['course_name']; ?></td>
                                                    <td><?php echo $row['section']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td> 
                                                        <form action="teacher_enrollment.php?sid=<?php echo $src; ?>" method="post">
                                                            <input type="hidden" name="course_code" value="<?=$row['course_code'];?>">
                                                            <input type="hidden" name="section" value="<?=$row['section'];?>">
                                                            <input type="submit" name="accept" class="btn btn-outline-primary" value="Accept" >
                                                        </form>
                                                        
                                                    </td>
                                                    <td>
                                                        <form action="teacher_enrollment.php?sid=<?php echo $src; ?>" method="post">
                                                            <input type="hidden" name="course_code" value="<?=$row['course_code'];?>">
                                                            <input type="hidden" name="section" value="<?=$row['section'];?>">
                                                            <input type="submit" name="drop" class="btn btn-outline-danger" value="Drop" >
                                                        </form>
                                                    </td>
                                                </tr>
                                        
                                                <?php
                                                        
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                    <div id="rc" class="tab-pane fade">
                        <div class="container text-center">
                            <?php
                                $qy = mysqli_query($con,"select * from enrolled_courses where S_Id = '$src' and flag = '100' ");
                                if(mysqli_fetch_assoc($qy)){
                            ?>
                            <h4 class="mt-5">Running Courses</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive mt-5">
                                        <table class="table">
                                            <thead>
                                                <th>Semester</th>
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Section</th> 
                                                <th>Type</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php   
                                                    $qry = mysqli_query($con,"select * from enrolled_courses,courses where enrolled_courses.course_code = courses.course_code and S_Id = '$src' and flag = '100'");
                                                    while($row = mysqli_fetch_array($qry)){
                                                ?>
                                            
                                                <tr>
                                                    <td><?php echo $row['sem']; ?></td>
                                                    <td><?php echo $row['course_code']; ?></td>
                                                    <td><?php echo $row['course_name']; ?></td>
                                                    <td><?php echo $row['section']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td>
                                                        <form action="teacher_enrollment.php?sid=<?php echo $src; ?>" method="post">
                                                            <input type="hidden" name="course_code" value="<?=$row['course_code'];?>">
                                                            <input type="hidden" name="section" value="<?=$row['section'];?>">
                                                            <input type="submit" name="drop" class="btn btn-outline-danger" value="Drop" >
                                                        </form>
                                                    </td>
                                                </tr>
                                        
                                                <?php
                                                        
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                    <div id="cc" class="tab-pane fade"><p>3. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quas deserunt nam reprehenderit rerum magni quos quod laudantium ducimus harum?</p></div>
                    <div id="mk" class="tab-pane fade"><p>3. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quas deserunt nam reprehenderit rerum magni quos quod laudantium ducimus harum?</p></div>
                
                </div>
            </div>
           
        </main>
</div>



<div class="text-center mt-5">
        <a href="teacher_enrollment.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>


<!-- bootstrap js, jquery, popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>

