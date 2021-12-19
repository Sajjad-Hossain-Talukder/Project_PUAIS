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

    $cc = $_GET['ccd'] ; 
    $sec = $_GET['sec'];
    $sess =  $_GET['sess'];

   
    $r = mysqli_query($con,"select * from courses where course_code = '$cc'"); 

    $row = mysqli_fetch_assoc($r);
    $name = $row['course_name'];

        
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
    <title><?php echo $name; ?> | Classroom </title>
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

<h3 class="text-center mt-5"><?php echo $name; ?></h3>
<h6 class="text-center">Course Code : <?php echo $cc; ?></h6>


<div class="container mt-5">
        <main>
            <div class="other-section">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item"><a data-toggle="pill" class="nav-link active" href="#cs"> <h6>Class Stream</h6> </a></li>
                    <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#cw"> <h6>Assignments</h6> </a></li>
                    <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#stu"> <h6>Students</h6> </a></li>
                    <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#ts"> <h6>Tests</h6> </a></li>
                    <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#mk"> <h6>Marks</h6> </a></li>
                </ul>

                <div class="tab-content">
                    <div id="cs" class="tab-pane active"></div>
                    <div id="cw" class="tab-pane fade">
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <form method="post" >
                                        <div class="card text-center mt-5 border-dark">
                                            <div class="card-header">
                                                <h4 class="text-center mt-3">Assignment Announcement</h4>
                                            </div>
                                            <div class="card-body text-center">
                                                <label for="atype"><h6>Assignment Type</h6></label> <br>
                                                <select name="atype" class="text-center" style="width:70%;" required>
                                                    <option value="Class Assignment">Class Assignment</option>
                                                    <option value="Mid Assignment">Mid Assignment</option>
                                                    <option value="Final Assignment">Final Assignment</option>
                                                </select> <br><br>
                                    
                                                <label for="title"><h6>Title</h6></label> <br>
                                                <textarea rows = "2" cols = "45" name = "title" required ></textarea> <br><br>

                                                <label for="syll"><h6>Description</h6></label> <br>
                                                <textarea rows = "4" cols = "45" name = "syll" required ></textarea> <br><br>

                                                <label for="num"><h6>Points</h6></label><br>
                                                <input type="number" name="num"  class="text-center" style="width:70%;" required> <br><br>
                                                    
                                                <label for="edate"><h6>Due Date</h6> </label> <br>
                                                <input type="date" name="edate" style="width:70%;" class="text-center" required> <br><br>

                                                <label for="etime"><h6>Due Time</h6></label><br>
                                                <input type="time" name="etime" style="width:70%;" class="text-center" required><br><br>
                                          
                                            
                                                <input type="submit" name="assign" value="Assign" class="btn btn-success" style="width:70%;"><br><br>

                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                        if( isset($_POST['assign'])){
                                        
                                            $type = $_POST['atype'];
                                            $title = $_POST['title'];
                                            $detail = $_POST['syll'];
                                            $ddate= $_POST['edate'];
                                            $dtime= $_POST['etime'];
                                            $point = $_POST['num'];
                                            date_default_timezone_set('Asia/Dhaka');
                                            $tdate = date("Y-m-d");
                                            $ttime = date("H:i:s"); 

                                            mysqli_query($con,"insert into assignment values('$cc','$sec','$sess','$type','$title','$detail','$tdate','$ttime','$ddate','$dtime','$point','0')");

                                        }
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card mt-5 border-dark">
                                        <div class="card-header">
                                            <h4 class="text-center mt-3">Assignment History</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                                <?php
                                                    $ca = 0  ; 
                                                    $ma = 0 ; 
                                                    $fa = 0 ; 

                                                    $r = mysqli_query($con,"select *  from assignment where course_code ='$cc' and section ='$sec' and session_year ='$sess' ");
                                                    while($c = mysqli_fetch_array($r)){
                                                        
                                                ?>

                                                <div class="card mt-3">
                                                    <div class="card-header">
                                                        <h5><?php 
                                                            if (  $c['atype'] == 'Class Assignment') {
                                                                $ca = $ca + 1 ; 
                                                                echo $c['atype']." - ". $ca ; 
                                                            }
                                                            else if (  $c['atype'] == 'Mid Assignment') {
                                                                $ma = $ma + 1 ; 
                                                                echo $c['atype']." - ". $ma ; 
                                                            }
                                                            else {
                                                                $fa = $fa + 1 ; 
                                                                echo $c['atype']." - ". $fa ; 
                                                            }
                                                        ?></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-10">
                                                                    <h6>Title :  <?php echo $c['title'];?></h6>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <h6 class="text-right"> <?php echo $c['point'];?> Points  </h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-5  btn btn-outline-dark m-1">
                                                                    <h6 class="text-center">Posted <p class="text-success"> 
                                                                    <?php
                                                                        $date=date_create($c['adate']);
                                                                        $time =date_create($c['atime']);
                                                                        echo date_format($date,"d F , Y ") ;
                                                                        echo date_format($time,"h:i A");
                                                                    ?> 
                    
                                                                    </p></h6>
                                                                </div>
                                                                <div class="col-lg-5  btn btn-outline-dark m-1">
                                                                    <h6 class="text-center"> Due   <p class="text-danger"> <?php
                                                                        $date=date_create($c['ddate']);
                                                                        $time =date_create($c['dtime']);
                                                                        echo date_format($date,"d F , Y ") ;
                                                                        echo date_format($time,"h:i A");
                                                                    ?>  </p></h6>
                                                                </div>
                                                                <div class="col-lg-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                    <div class="card-footer text-center">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <form method="post">
                                                                        <input type="hidden" name="ada" value="<?=$c['adate']?>">
                                                                        <input type="hidden" name="ati" value="<?=$c['atime']?>">
                                                                        <input type="submit" name="dis"  value="Discard Assignment" class="btn btn-danger text-center" style="width:100%;">
                                                                    </form>
                                                                    <?php 
                                                                    if(isset($_POST['dis'])){
                                                                        $ada = $_POST['ada'];
                                                                        $ati = $_POST['ati']; 
                                                                        mysqli_query($con,"delete from assignment where course_code ='$cc' and section ='$sec' and session_year ='$sess' and adate = '$ada' and atime = '$ati' ");
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <form action="teacher_view_assignment.php?cc=true">
                                                                        <input type="hidden" name="ccd" value="<?php echo $cc ; ?>">
                                                                        <input type="hidden" name="sec" value="<?php echo $sec ; ?>">
                                                                        <input type="hidden" name="sess" value="<?php echo $sess; ?>">
                                                                        <input type="hidden" name="ada" value="<?=$c['adate']?>">
                                                                        <input type="hidden" name="ati" value="<?=$c['atime']?>">

                                                                        <input type="submit" name="subm" value="View Assignment" class="btn btn-outline-dark" style="width:100%">
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                                <?php
                                                    }
                                                ?>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="stu" class="tab-pane fade">
                        <table class="table text-center mt-5">
                            <tr>
                                <th>Student ID </th>
                                <th>Student Name</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                            <?php 
                                $a = mysqli_query($con,"select * from enrolled_courses,student where enrolled_courses.S_Id = student.S_Id and flag ='100' and section='$sec' and course_code = '$cc' ");
                                while( $b = mysqli_fetch_array($a)){
                            ?>
                            <tr>
                                <td><?php echo $b['S_Id'];?></td>
                                <td><?php echo $b['S_name'];?></td>
                                <td><?php echo $b['type'];?></td>
                                <td>
                                    <form action="teacher_contact_student.php?sid=<?=$b['S_Id']?>" method="post">
                                        <input type="submit" name="submi" value="Contact" class="btn btn-warning">
                                    </form>

                                </td>
                            </tr>
                            <?php 
                                }
                            ?>

                        </table>
                    </div>
                    <div id="ts" class="tab-pane fade"> 
                        
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-lg-6">
                                    <form method="post" >
                                        <div class="card text-center mt-5 border-dark">
                                            <div class="card-header">
                                                <h4 class="text-center mt-3">Exam Announcement</h4>
                                            </div>
                                            <div class="card-body">
                                    
                                                    <label for="etype"> <h6>Exam Type</h6> </label> <br>
                                                    <select name="etype" class="text-center" style="width:70%;" required>
                                                        <option value="Class Test">Class Test</option>
                                                        <option value="Mid Term">Mid Term</option>
                                                        <option value="Final Term">Final Term</option>
                                                        <option value="Quiz"> Quiz</option>
                                                        <option value="Project Presentation">Project Presentation</option>
                                                        <option value="Presentation">Presentation</option>   
                                                    </select> <br><br>

                                                    <label for="syll"><h6>Syllabus</h6></label> <br>
                                                    <textarea rows = "5" cols = "45" name = "syll" required ></textarea> <br><br>

                                                    <label for="num"><h6>Points</h6></label><br>
                                                    <input type="number" name="num"  class="text-center" style="width:70%;" required> <br><br>
                                                    
                                                    <label for="edate"><h6>Exam Date</h6> </label> <br>
                                                    <input type="date" name="edate" style="width:70%;" class="text-center" required> <br><br>

                                                    <label for="etime"><h6>Exam Time</h6></label><br>
                                                    <input type="time" name="etime" style="width:70%;" class="text-center" required><br><br>
                                          
                                            
                                                    <input type="submit" name="announc" value="Announce" class="btn btn-success" style="width:70%;"><br><br>

                                            </div>
                                        </div>
                                    </form>
                                <?php
                                    if( isset($_POST['announc'])){
                                        $etype  = $_POST['etype'];
                                        $syll= $_POST['syll'];
                                        $edate= $_POST['edate'];
                                        $etime= $_POST['etime'];
                                        $point = $_POST['num'];
                                        mysqli_query($con,"insert into exam_sch values('$cc','$sec','$sess','$etype','$syll','$edate','$etime','$point')");


                                    }
                                ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card text-center mt-5 border-dark">
                                        <div class="card-header">
                                            <h4 class="text-center mt-3">Exam History</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>Exam Type</th>
                                                    <th>Exam Date</th>
                                                    <th>Exam Time</th>
                                                    <th>Points</th>
                                                </tr>
                                                <?php
                                                     $r = mysqli_query($con,"select * from exam_sch where course_code ='$cc' and section ='$sec' and session_year ='$sess' order by edate desc ");
                                                     while($c = mysqli_fetch_array($r)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $c['etype'];?></td>
                                                    <td><?php echo $c['edate'];?></td>
                                                    <td><?php echo $c['etime'];?></td>
                                                    <td><?php echo $c['point'];?></td>

                                                </tr>
                                                <?php
                                                    }
                                                ?>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="mk" class="tab-pane fade"><p>3. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quas deserunt nam reprehenderit rerum magni quos quod laudantium ducimus harum?</p></div>
                </div>
            </div>
           
        </main>
</div>

<div class="text-center mt-5">
        <a href="teacher_class_stream.php?logout=log" class="btn-lg btn-danger">LogOut</a>
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





                                   