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
    $q   =  mysqli_query($con,"select * from advisor where S_Id = '$sid'");

    if ( $row = mysqli_fetch_array($q)){
        $tid = $row['T_Id'];
        $qr  = mysqli_query($con, "select * from teacher where T_Id = '$tid'");
        $r   = mysqli_fetch_array($qr);

        $image = $r['image'];
        $tname = $r['T_name'];
        $dept = $r['dept'];
        $desi = $r['designation'];
        $em = $r['email'];
        $mb = $r['contact'];
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
    <title>Contact Advisor</title>
</head>

<body>

<div class="container p-3 mt-2 first">
   
   <div class="row">
       <div class="col-lg-3 col-sm-12 col-md-12"></div>
       
       <div class="col-lg-2 col-sm-12 col-md-12 text-center" >
           <a href="admin_dashboard.php" style="text-decoration:none;"><img src="images/puc.png" class="img-fluid">  </a>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2"> </div>  
        <div class="col-lg-4">
            <div class="card my-5 border-dark" >
                <div class="card-header"><h3 class="text-center">Advisor</h3></div>
                <div class="card-body text-center">
                        <br>
                        <img class="img-fluid img-thumbnail rounded p-3 " src="uploaded_images/<?php echo $image;?>"> <hr>
                             
                        <div >  <h5 class="text-center"><?php echo $tname;?></h5> </div>
                        <div >  <p class=" fs-5 fw-normal mb-0"><?php echo $desi;?></p> </div>
                        <div >  <p class="text-center fs-6 fw-normal mb-0">Email : <?php echo $em;?></p> </div>
                        <div >  <p class="text-center fs-6 fw-normal mb-0">Contact : +88<?php echo $mb;?></p> </div>
                        

                 </div>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="card my-5 border-dark">
                    <div class="card-header">
                        <h3 class="text-center">Conatact</h3>
                    </div>
                    <div class="card-body text-center">
                        <h6 >Send Short Message(1500)</h6>

                        <form method = "post">
                            <br>
                            <textarea rows = "5" cols = "35" name = "msg"></textarea><br>
                            <input type = "submit" value = "Send Message" name="subm" class="btn btn-outline-dark my-2"  style="width:60%;"/>
                        </form>
                        <?php
                            if(isset($_POST['subm'])){
                                $msg = $_POST['msg']; 
                                mysqli_query($con,"insert into message(sby,rby,seen,message) values('$sid','$tid',0,'$msg')");
                            }
                        ?>
                        
                        <h6>OR</h6>
                        
                        <a href="mailto:<?php echo $em;?>" class="btn btn-outline-dark my-2" style="width:60%;" > Send Mail </a>


                    </div>
                </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<div class="text-center mt-5">
        <a href="student_contact_advisor.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>
<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    
</body>
</html>