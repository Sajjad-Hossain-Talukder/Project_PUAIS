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
    <title>Inbox | <?php echo $row['S_name'];?></title>
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



<div class="container mt-5">
    <div class="other-section">
        <div >
            
                <h4 class="btn btn-primary">Received Message</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 mt-4">

                         <?php 
                            $a = mysqli_query($con,"select * from message where rby = '$sid' order by sdate desc");
                            while( $row = mysqli_fetch_array($a)){
                                $sby = $row['sby'];
                                $b =  mysqli_query($con,"select * from student where S_Id = '$sby'");
                                if( $tba = mysqli_fetch_assoc($b) ){
                            ?>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <?php 
                                            $date=date_create($row['sdate']);
                                        if($row['seen'] =='0' ){
                                        ?>
                                                <b><?php echo $tba['S_name']; ?> | Student </b>
                                                <h6><?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?></h6>
                                        <?php 
                                            }
                                            else {
                                        ?>
                                                <?php echo $tba['S_name']; ?> | Student <br>
                                                <?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?>
                                        <?php
                                            }
                                        ?>
                                        <a href="student_inbox.php?adat=<?=$row['sdate']?>&sby=<?=$row['sby']?>&nam=<?=$tba['S_name']?>" class="card-link stretched-link"></a>

                                    </div>
                                </div>
                            <?php
                                    }
                                    else {
                                        $c =  mysqli_query($con,"select * from teacher where T_Id = '$sby'");
                                        $tba = mysqli_fetch_assoc($c) ;
                                        
                            ?>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <?php 
                                        $date=date_create($row['sdate']);
                                        if($row['seen'] =='0' ){
                                        ?>
                                            <b><?php echo $tba['T_name']; ?> | Teacher </b>
                                            <h6><?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?></h6>
                                        <?php 
                                        }
                                        else {
                                        ?>
                                                <?php echo $tba['T_name']; ?> | Teacher <br>
                                                <?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?>
                                        <?php
                                        }
                                        ?>

                                        <a href="student_inbox.php?adat=<?=$row['sdate']?>&sby=<?=$row['sby']?>&nam=<?=$tba['T_name']?>" class="card-link stretched-link"></a>

                                    </div>
                                </div>

                            <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="col-lg-9 mt-4">
                            <?php 
                                if(@$_GET['adat']){
                                    $adate =  $_GET['adat'];
                                    $sby =  $_GET['sby'];
                                    $nam = $_GET['nam'];
                                    $mg = mysqli_query($con,"select * from message where sby = '$sby' and sdate = '$adate'");
                                    $g = mysqli_fetch_assoc($mg);
                                    $val = "1";
                                    mysqli_query($con , "update message set seen ='$val' where sby = '$sby' and sdate = '$adate' ");
            
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo $nam;?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $g['message'];?></p>
                                        <details>
                                            <summary class="btn btn-outline-dark">Reply</summary> <br> <br>
                                            <form method="post">
                                                <textarea rows = "4" cols = "50" name = "msg"></textarea><br>
                                                <input type="submit" name="send" value="Send" class="btn btn-primary">
                                            </form>
                                            <?php
                                                if(isset($_POST['send'])){
                                                    $msg = $_POST['msg'];

                                                    mysqli_query($con,"insert into message values('$sid','$sby','$today','0','$msg')");
                                                }
                                            ?>
                                        </details>
                                    </div>

                                </div>
                            <?php
                                }
                            ?>
                    </div>
                </div>
                
            </div>
            

           
            <h4 class="btn btn-primary mt-5">Sent Message</h4>
                
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 mt-4">
                            <?php 
                                $a = mysqli_query($con,"select * from message where sby = '$sid' order by sdate desc");
                                while( $row = mysqli_fetch_array($a)){
                                    $rby = $row['rby'];
                                    $b =  mysqli_query($con,"select * from student where S_Id = '$rby'");
                                    if( $tba = mysqli_fetch_assoc($b) ){
                                ?>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <?php 
                                                $date=date_create($row['sdate']);
                                            if($row['seen'] =='0' ){
                                            ?>
                                                    <b><?php echo $tba['S_name']; ?> | Student </b>
                                                    <h6><?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?></h6>
                                            <?php 
                                                }
                                                else {
                                            ?>
                                                    <?php echo $tba['S_name']; ?> | Student <br>
                                                    <?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?>
                                            <?php
                                                }
                                            ?>
                                            <a href="student_inbox.php?adate=<?=$row['sdate']?>&rby=<?=$row['rby']?>&nam=<?=$tba['S_name']?>" class="card-link stretched-link"></a>

                                        </div>
                                    </div>
                                <?php
                                        }
                                        else {
                                            $c =  mysqli_query($con,"select * from teacher where T_Id = '$rby'");
                                            $tba = mysqli_fetch_assoc($c) ;
                                            
                                ?>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <?php 
                                            $date=date_create($row['sdate']);
                                            if($row['seen'] =='0' ){
                                            ?>
                                                <b><?php echo $tba['T_name']; ?> | Teacher </b>
                                                <h6><?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?></h6>
                                            <?php 
                                            }
                                            else {
                                            ?>
                                                    <?php echo $tba['T_name']; ?> | Teacher <br>
                                                    <?php echo date_format($date,"d F,Y ");?> | <?php echo date_format($date,"h:i A ");?>
                                            <?php
                                            }
                                            ?>

                                            <a href="student_inbox.php?adate=<?=$row['sdate']?>&rby=<?=$row['rby']?>&nam=<?=$tba['T_name']?>" class="card-link stretched-link"></a>

                                        </div>
                                    </div>

                                <?php
                                        }
                                    }
                                ?>
                        </div>
                        <div class="col-lg-9 mt-4">
                            <?php 
                                if(@$_GET['adate']){
                                    $adate =  $_GET['adate'];
                                    $rby =  $_GET['rby'];
                                    $nam = $_GET['nam'];
                                    $mg = mysqli_query($con,"select * from message where sby = '$sid' and sdate = '$adate'");
                                    $g = mysqli_fetch_assoc($mg);
                                    $val = "1";
                                    mysqli_query($con , "update message set seen ='$val' where sby = '$sid' and  rby = '$rby' and sdate = '$adate' ");
            
                            ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo $nam;?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p><?php echo $g['message'];?></p>
                                    </div>

                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            

        </div>

    </div>     
</div>



<div class="text-center mt-5">
    <a href="student_courses.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
    <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>   
    
</body>
</html>

