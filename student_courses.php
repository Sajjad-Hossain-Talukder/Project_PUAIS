<?php
    session_start();
    include("connection1.php");
    if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){
        
        if( @$_GET['logout'] == true ){
            session_destroy();
            header('location:index.php');
        }
    }
    else header('location:index.php');
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
    <title>My Courses</title>
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

    <h3 class="text-center mt-5">My Courses</h2>

    <div class="container">
        <div class="row">   
            <?php
                $sid = $_SESSION['sid'] ; 
                $sql = "select * from enrolled_courses , courses where S_Id = '$sid' and flag ='100' and  courses.course_code = enrolled_courses.course_code" ; 
                $q = mysqli_query($con,$sql);

                while($row = mysqli_fetch_array($q)){
                    $sec = $row['section'] ; 
                    $cc = $row['course_code'];
                    $qry = mysqli_query($con,"select * from teacher, offered_courses where course_code = '$cc' and section = '$sec' and offered_courses.T_Id = teacher.T_Id");
                    $dt =  mysqli_fetch_assoc($qry);
            ?>
                    
                    
            <div class="col-md-3 col-sm-12">  
                <div class="card mt-5" >   
                    <img class="card-img-top img-fluid" src="uploaded_images/<?=$row['image']?>" alt="Card image cap">
                    <div class="card-body">
                            <div style="height:100px;">
                                <h5 class="card-title"  > <?=$row['course_name']?> </h5>
                                <h6 class="" ><?=$dt['T_name']?></h6>
                            </div>
                            
                            <hr>
                                
                            <h6 class="card-text  text-center" >Course Code : <?=$cc?></h6>
                            <h6 class="card-text  text-center" >Semester : <?=$row['sem']?></h6>
                            <h6 class="card-text  text-center" >Section : <?=$sec?></h6>
                            <h6 class="card-text  text-center" >Credits : <?=$row['credit']?></h6>
                            <h6 class="card-text  text-center" >Type : <?=$row['type']?></h6>
                            
                    </div>

                    <div class="card-footer">
                        <form action="student_class_stream.php?cc=true">
                            <input type="hidden" name="ccd" value="<?=$row['course_code']?>">
                            <input type="hidden" name="sec" value="<?=$row['section']?>">
                            <input type="hidden" name="sess" value="<?=$row['session_year']?>">
                            <input type="hidden" name="tname" value="<?=$dt['T_name']?>">
                            <input type="hidden" name="tid"   value="<?=$dt['T_Id']?>">
                            <input type="submit" name="subm" value="Details" class="btn btn-outline-dark" style="width:100%">
                        </form>
                    </div>

                </div>
                   
            </div>
                    

            <?php
                }
            ?>
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

                                