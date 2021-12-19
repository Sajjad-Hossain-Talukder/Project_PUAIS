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
    $sid = $_SESSION['sid'];

        $cc = $_GET['ccd'] ; 
        $sec = $_GET['sec'];
        $sess = $_GET['sess'];
        $tname = $_GET['tname'];
        $tid = $_GET['tid'];

    date_default_timezone_set('Asia/Dhaka');
    $tdate= date("Y-m-d"); 
    $ttime = date("H:i:s"); 
    $today = date ("Y-m-d H:i:s");

    $r = mysqli_query($con,"select * from courses where course_code = '$cc'"); 
    while($row = mysqli_fetch_assoc($r)){
        $name = $row['course_name'];
    }


    $t = mysqli_query($con,"select * from teacher where T_Id = '$tid'"); 
    while($rw = mysqli_fetch_assoc($t)){
        $image = $rw['image'];
    }

    $nw = mysqli_query($con,"select count(course_code) as total from enrolled_courses where course_code = '$cc' and section = '$sec' and flag='100'"); 
    while($nw1 = mysqli_fetch_assoc($nw)){
        $total = $nw1['total'];
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
    <title><?php echo $name; ?> | Classroom</title>
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
 
    

    <h3 class="text-center mt-5"><?php echo $name; ?></h3>
    <h5 class="text-center"> Course Code : <?php echo $cc; ?></h5>

    <div class="mt-5">
        <div class="other-section container">

            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item"><a data-toggle="pill" class="nav-link active" href="#stream"> <h6>Clsss Stream</h6></a></li>
                <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#cw"><h6>Class Work</h6></a></li>
                <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#ex"><h6>Exam</h6></a></li>
                <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#st"><h6>People</h6></a></li>
                <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#mk"><h6>Marks</h6></a></li>    
            </ul>

            <div class="tab-content">
                <div id="stream" class="tab-pane active"> </div>
                <div id="cw" class="tab-pane fade">
                    <div class="container">
                        <div class="row">
                            <?php 

                                $y = mysqli_query($con,"select * from assignment,enrolled_courses,courses where assignment.course_code ='$cc' and enrolled_courses.course_code = courses.course_code and enrolled_courses.S_Id = '$sid' and flag='100' and assignment.course_code = enrolled_courses.course_code and assignment.section = enrolled_courses.section");
                                while($wr = mysqli_fetch_array($y)){
                            ?>
                                <div class="col-lg-4">
                                    <div class="card text-center mt-3">
                                        <h5 class="mt-3"> <?php echo $wr['atype'];?></h5> <hr> 
                                        <?php $date=date_create($wr['ddate']);
                                            echo date_format($date,"d F , Y ")
                                        ?>

                                        <?php
                                            $ddate = $wr['ddate'];
                                            if( $tdate <= $ddate )  {
                                        ?>
                                            <h6 class="text-success">Pending</h6>
                                        <?php
                                            } 
                                        else {
                                        ?>
                                            <h6 class="text-danger">Missed</h6>
                                        <?php 
                                            }
                                        ?>
                                        <br>
                                    
                                        <form action="student_view_assignment.php" method="GET">
                                            <input type="hidden" name="ccd" value="<?=$wr['course_code']?>">
                                            <input type="hidden" name="sec" value="<?=$wr['section']?>">
                                            <input type="hidden" name="sess" value="<?=$wr['session_year']?>">
                                            <input type="hidden" name="ada" value="<?=$wr['adate']?>">
                                            <input type="hidden" name="ati" value="<?=$wr['atime']?>">
                                            <input type="submit" name="submi" value="Details" class="btn btn-outline-dark" >
                                        </form>
                                        <br><br>
                                    </div>
                                </div>
                            
                            
                                <?php
                                    }
                                ?>

                        </div>
                    </div>
                </div>
                <div id="ex" class="tab-pane fade"> 
                    <div class="container">
                        <div class="row">
                            <?php 
                            $q = mysqli_query($con,"select * from exam_sch where course_code = '$cc' and section = '$sec' and session_year ='$sess' order by edate desc ");
                                while( $rw = mysqli_fetch_array($q)){
                                ?>
                                <div class="col-lg-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4> <?php echo $rw['etype']; ?> </h4> <hr>
                                            
                                            <h5><?php echo $rw['esyllabus']; ?> </h5> <br>
                                         
                                            <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-lg-1"></div>
                                                                <div class="col-lg-5  btn btn-outline-dark m-1">
                                                                    <h6 class="text-center">Date <p class="text-success"> 
                                                                    <?php 
                                                                        $date = date_create($rw['edate']); 
                                                                        echo date_format($date,"d F , Y "); 
                                                                    ?> 
                                            
                                                                    </p></h6>
                                                                </div>
                                                                <div class="col-lg-5  btn btn-outline-dark m-1">
                                                                    <h6 class="text-center"> Time   <p class="text-danger">                                             <?php 
                                                                        $date = date_create($rw['etime']); 
                                                                        echo date_format($date,"h:i A"); 
                                                                        ?> 
                                                                    </h6> </p></h6>
                                                                </div>
                                                                <div class="col-lg-1"></div>
                                                            </div>
                                                        </div>


                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="st" class="tab-pane fade">  
                    <br>
                    <h4 >Teachers</h4><hr>
                    <div class="col-lg-6 text-center">
                       
                        <table class="table table-borderless">
                            <tr>
                                <td><img src="uploaded_images/<?php echo $image;?>" class="img-fluid" style="border-radius:50%;max-width: 100%;max-height:40px;" >  </td>
                                <td><h5><?php echo $tname;?></h5></td>
                            </tr>
                        </table>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Classmates </h4>
                        </div>
                        <div class="col-lg-6 text-center">
                            <h5><?php echo $total ; ?> Students</h5>
                        </div>
                    </div>
                    
                   
                    <hr><br>


                    <div class="col-lg-6">

                        <table class="table table-borderless "> 
                            <?php 
                                $q = mysqli_query($con,"select * from enrolled_courses,student where course_code = '$cc' and section = '$sec'and flag = '100' and enrolled_courses.S_Id = student.S_Id");
                                while( $row = mysqli_fetch_array($q)){
                            ?>
                                <tr>
                                    <td class="text-center" ><img src="uploaded_images/<?php echo $row['image'];?>" class="img-fluid" style="border-radius:50%;max-width: 100%;max-height:40px;" >  </td>
                                    <td><h6><?php echo $row['S_name'];?></h6></td>
                                </tr>
                            <?php
                                }  
                            ?>

                        </table>
                    </div>
                </div>
                <div id="mk" class="tab-pane fade"><p>3. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quas deserunt nam reprehenderit rerum magni quos quod laudantium ducimus harum?</p></div>
                    
            </div>

        </div>
    </div>




   
    <br>
    <br>
    
    <div class="logout text-center ">
        <a href="student_class_stream.php?logout=log" class="btn btn-danger">LogOut</a>
    </div>

    <div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    
</body>
</html>

                                   