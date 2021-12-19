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
    $r = mysqli_query($con,"select * from student where S_Id = '$sid'");
    $row = mysqli_fetch_assoc($r);


    $bt = $row['batch'];

    $p = mysqli_query($con,"select * from advisor,teacher where S_Id = '$sid' and teacher.T_Id = advisor.T_Id");
    $adv = mysqli_fetch_assoc($p);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <style>
        .intr{
            border-radius : 5px ; 
            border : 1px solid gray;
        }
        .intr:hover{
            background-color : #D8DAFC ;
            border : none;
        }
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
        .mn{
            text-align:center;
            border-radius : 10px;
        }
        .mn:hover{
            color: white;
            text-align:center;
            border-radius : 10px;
            background-image: linear-gradient(to right top, #bcbcbc, #c2c2c2, #c9c9c9, #cfcfcf, #d6d6d6);
            padding-top : 20px;
        }

    </style>
    <title>Dashboard | <?php echo $row['S_name'];?></title>
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


    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-2 col-sm-2" > 
                <div class="card border-dark intro">
                    <div class="card-body">
                        <h5 class="text-center">Steering</h5>
                        <hr>
                        <div class="mn">
                            <a href="student_dashboard.php" ><i class="material-icons icn">dashboard </i><h6>Dashboard</h6></a> <br>
                        </div>
                        <div class="mn">
                            <a href="student_courses.php"><i class="material-icons icn">book </i><h6>My Courses</h6></a><br>
                        </div>
                        <div class="mn">
                            <a href="student_enrollment.php"><i class="material-icons icn">inventory </i><h6>Enrollment</h6></a> <br>
                        </div>
                        <div class="mn">
                            <a href="#"><i class="material-icons icn">broken_image </i><h6>Evaluation</h6></a> <br>
                        </div>
                        <div class="mn">
                            <a href="student_payment.php"><i class="material-icons icn">credit_card </i><h6>Payment</h6></a> <br>
                        </div>
                        <div class="mn">
                            <a href="#"><i class="material-icons icn">grade </i><h6>Marksheets</h6></a><br>
                        </div>
                        <div class="mn">
                            <a href="#"><i class="material-icons icn">summarize </i><h6>Reports</h6></a><br>
                        </div>
                        <div class="mn">
                            <a href="#"><i class="material-icons icn">quiz </i><h6>Exam FAQs</h6></a><br>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 border-dark intro">
                    <h4 class="text-center mt-3">Calender</h4>
                    <div data-tockify-component="calendar" data-tockify-calendar="know.what"></div>
                    <script data-cfasync="false" data-tockify-script="embed" src="https://public.tockify.com/browser/embed.js"></script>
                </div>
            </div>
            <div class="col-lg-8 col-sm-8">
                <div class="card intro mt-3 p-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="uploaded_images/<?php echo $row['image']?>"class="img-fluid rounded" style="max-height:100px;">
                            </div>
                            <div class="col-lg-10 text-center">
                                <h4>Hello ,  <span style="color:#1461AA; font-size:30px;"> <?php echo $row['S_name']?> </span>  !</h4>
                                <h1>Welcome to PUAIS</h1>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="card intro mt-4">
                    <div class="card-header"><h5 class="text-center">Basic Info</h5></div>
                    <div class="card-body text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 dv"> 
                                    <i class="material-icons">perm_identity</i><br>
                                    <h6><?php echo $row['S_Id']?></h6>  <br>
                                </div>
                                <div class="col-lg-6 dv">
                                    <i class="material-icons">batch_prediction</i><br>
                                    <h6><?php echo $row['batch']?> Batch</h6> <br>
                                </div>
                                <div class="col-lg-6 dv">
                                    <i class="material-icons">account_balance</i><br>
                                    <h6><?php echo $row['dept']?></h6> <br>
                                </div>
                                <div class="col-lg-6 dv">
                                    <i class="material-icons">email</i><br>
                                    <h6><?php echo $row['email']?></h6><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-lg-5  p-3 m-4 intr">
                                <h4> <a href="student_profile.php">Profile</a> </h4>
                            </div>
                            <div class="col-lg-5  p-3 m-4 intr" >
                                <h4>Education & Skills</h4>
                            </div>
                            <div class="col-lg-5  p-3 m-4 intr">
                                <h4>Licenses & Certifications</h4>
                            </div>
                            <div class="col-lg-5  p-3 m-4 intr">
                                <h4>Accomplishments</h4>
                            </div>
                           
                            
                        </div>
                    </div>

                </div>
                <div class="card text-center intro mt-4">
                    <div class="card-header">
                        <h4 class="text-center">Assignments History</h4>
                    </div>
                    <div class="card-body text-center">
                        <table class="table">
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Type</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th></th>
                            </tr>

                        <?php 
                            $y = mysqli_query($con,"select * from assignment,enrolled_courses,courses where enrolled_courses.course_code = courses.course_code and enrolled_courses.S_Id = '$sid' and flag='100' and assignment.course_code = enrolled_courses.course_code and assignment.section = enrolled_courses.section");
                            while($wr = mysqli_fetch_array($y)){
                        ?>
                            <tr>
                                <td><?php echo $wr['course_code'];?></td>
                                <td><?php echo $wr['course_name'];?></td>
                                <td><?php echo $wr['atype'];?></td>
                                <td>
                                    <?php $date=date_create($wr['ddate']);
                                    echo date_format($date,"d F , Y ")
                                    ?>
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    <form action="student_view_assignment.php" method="GET">
                                        <input type="hidden" name="ccd" value="<?=$wr['course_code']?>">
                                        <input type="hidden" name="sec" value="<?=$wr['section']?>">
                                        <input type="hidden" name="sess" value="<?=$wr['session_year']?>">
                                        <input type="hidden" name="ada" value="<?=$wr['adate']?>">
                                        <input type="hidden" name="ati" value="<?=$wr['atime']?>">
                                        <input type="submit" name="submi" value="Details" class="btn btn-outline-dark" >
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </table>
                    </div>
                </div>
                <div class="card text-center mt-5 intro">
                    <div class="card-header">
                        <h4 class="text-center mt-3">Upcoming Exam Schedule</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Course code</th>
                                <th>Course Title</th>
                                <th>Exam Type</th>
                                <th>Exam Date</th>
                                <th>Exam Time</th>
                                <th>Points</th>
                            </tr>
                        <?php
                            $sid = $_SESSION['sid']; 
                            $r = mysqli_query($con,"select * from enrolled_courses , exam_sch where   enrolled_courses.S_Id ='$sid' and  enrolled_courses.course_code = exam_sch.course_code and enrolled_courses.section = exam_sch.section and enrolled_courses.session_year  = exam_sch.session_year and flag ='100' and edate >= '$today' order by edate");
                            while($c = mysqli_fetch_array($r)){
                                $cc = $c['course_code'];
                                $qr = mysqli_query($con,"select * from courses where course_code = '$cc'");
                                $res = mysqli_fetch_assoc($qr);

                        ?>
                            <tr>
                                <td><?php echo $cc;?></td>
                                <td><?php echo $res['course_name'];?></td>
                                <td><?php echo $c['etype'];?></td>
                                <td>
                                    <?php 
                                        $date=date_create($c['edate']);
                                        echo date_format($date,"d F , Y ")
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $date=date_create($c['etime']);
                                        echo date_format($date,"h:i A");
                                    ?>
                                </td>
                                <td><?php echo $c['point'];?></td>
                            </tr>
                        <?php
                            }
                        ?>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-2">
                <div class="card mt-2 border-dark intro" >
                    <div class="card-header"><h4 class="text-center">Advisor</h4></div>
                    <div class="card-body text-center">
                        <br>
                        <img class="img-fluid img-thumbnail rounded p-3 intro" src="uploaded_images/<?php echo $adv['image'];?>"> <hr>
                             
                        <div >  <h6 class="text-center"><?php echo $adv['T_name'];?></h6> </div>
                        <div >  
                            <p class="text-center"><?php echo $adv['designation']."<br>+88".$adv['contact'];?>
                            </p> 
                        </div>
                        <div> <a href="student_contact_advisor.php" class="text-center btn btn-warning">Contact</a></div>
                        
                        

                     </div>
                </div>
                <div class="card mt-3 p-5 border-dark intro" >
                    <a href="student_inbox.php" class="card-link stretched-link"> <h4 class="text-center"> I N B O X </h4></a>
                </div>

                <div class="card mt-3 border-dark intro" >
                    <h5 class="text-center mt-2">Batchmates</h5> <hr>
                    <div class="container">
                        <div class="row">
                            <?php  
                                $val = 1 ; 
                                $b = mysqli_query($con,"select * from student where batch = '$bt' and S_Id <> '$sid'"); 
                                while( $o = mysqli_fetch_array($b) and $val <= 4){
                                    $val = $val+1 ;
                            ?>
                            <div class="col-lg-6">
                                <img src="uploaded_images/<?php echo $o['image'];?>" class="img-fluid rounded" style="max-height:100px;">
                                <br>
                                <br>

                            </div>
                            <?php 
                                }
                            ?>
                            <div class="text-center">
                                <a href="student_batchmate.php" class="btn btn-success text-center" style="width:100%;">See All</a>
                            <br><br>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>










<div class="text-center mt-5">
    <a href="student_change_password.php" class="btn-lg btn-warning">Change Password</a> 
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

