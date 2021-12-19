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
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous" />
      <style>
        .first{
            border-radius : 20px;
            box-shadow : 1px 1px 10px gray ; 
        }
        a{
            text-decoration : none ; 
        }
        option{
            text-align:center;
        }
    </style>
    <title>Insert Courses</title>
</head>

<body>

    <div class="container p-3 mt-2 first">
    
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-12"></div>
            
            <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
                <a href="admin_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
            </div>
            <div class="col-lg-4 col-sm-12 col-md-12 mt-3">
            <a href="admin_dashboard.php" style="text-decoration:none; color :black; text-align:center">
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
            <div class="card text-center mt-4">
                <div class="card-header"> <h3 class="text-center"> Insert Courses </h3> </div>
                <div class="card-body">
            <form method="post" enctype="multipart/form-data">

                        <label for="sm">Semester</label> <br>
                        <select name="sm" required style="width:80%">
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                            <option value="6">Sixth</option>
                            <option value="7">Seventh</option>
                            <option value="8">Eighth</option>
                        </select>
                        <br><br>

                        <label for="cc"> Course Code  </label><br>
                        <input type="text" name ="cc" required style="width:80%"><br><br>

                        <label for="cn"> Course Name    </label><br>
                        <input type="text" name ="cn" required style="width:80%" ><br><br>


                        <label for="prec"> Pre-requisite Course Code </label><br>
                        <select name="prec" required style="width:80%">
                            
                            <?php 
                            $r = mysqli_query($con,"select * from courses");

                            while( $row = mysqli_fetch_array($r) ){
                            ?>
                                <option value="<?php echo $row['course_code']; ?>"><?php echo $row['course_name']; ?></option>
                            <?php
                            }
                            ?>

                        </select>
                        <br><br>

                        <label for="cdt"> Credits</label><br>
                        <input type="number" step="0.1" name ="cdt" required style="width:80%"> <br><br>

                        <label for="pic">Course Image </label> 
                        <input type="file" name="pic" required style="width:80%;margin-left : 28%;">
                        <br><br>
                    

                       
                </div>
                <div class="card-footer">
                    <input type="submit" value="Add Courses" name="sub" class="btn btn-primary" style="width:100%"><br>
            </form>
                </div>

            </div>

                <?php

                    if( isset($_POST['sub'])){

                        $sm = $_POST['sm'];
                        $cc = $_POST['cc'];
                        $cn = $_POST['cn'];
                        $prec = $_POST['prec'];
                        $cdt = $_POST['cdt'];
                    
                        $ext = explode(".",$_FILES['pic']['name']);
                        $c = count($ext);
                        $ext = $ext[$c-1];
                        $date = date("D:M:Y");
                        $time = date("h:i:s");
                        $image_name = md5($date.$time.$ext);
                        $image = $image_name.".".$ext;

                        if ( $sm == "1") $sem = 'First' ; 
                        else if ( $sm == "2" ) $sem = "Second";
                        else if ( $sm == "3" ) $sem = 'Third';
                        else if ( $sm == "4" ) $sem = 'Fourth' ; 
                        else if ( $sm == "5" ) $sem = 'Fifth';
                        else if ( $sm == "6" ) $sem = 'Sixth' ;
                        else if ( $sm == "7" ) $sem = 'Seventh' ; 
                        else $sem = 'Eighth';

                        $q = "insert into courses values ('$sem','$sm','$cc','$cn','$prec','$cdt','$image')";
                        


                        mysqli_query($con,$q);
                        $image_Tname = $_FILES['pic']['tmp_name'];
                        if($image != null ){
                            move_uploaded_file($image_Tname,"uploaded_images/".$image);
                        }
                    }

                ?>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="text-center mt-5">
                 <a href="admin_all_courses.php" class="btn-lg btn-danger">All Courses</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="text-center mt-5">
                <a href="admin_dashboard.php?logout=log" class="btn-lg btn-danger">LogOut</a>
            </div>
        </div>
    </div>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       


</body>
</html>
