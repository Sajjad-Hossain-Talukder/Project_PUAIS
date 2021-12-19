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
    <title>Advisorship</title>
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


<div class="text-center mt-5">
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="search" placeholder="Search by Studnet ID"  >
        <input type="submit" name="sub" value="Search" class="btn btn-outline-success">
    </form>
    <?php

        if( isset($_POST['sub'])){
            $src = $_POST['search']; 
            $tid = $_SESSION['tid'];

            if ( $src != NULL){
                $r = mysqli_query($con,"select * from advisor where S_Id ='$src' and T_Id = '$tid' ");
                if( $row = mysqli_fetch_assoc($r)){
                    $val = mysqli_query($con,"select * from student where S_Id = '$src'"); 
                    $dat =  mysqli_fetch_assoc($val);
    ?>

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
                                        <h4>Personal Info</h4>
                                </div>
                                <div class="card-body text-center">
                                        <h4><?php echo $dat['S_name']; ?></h4>
                                        <h6>ID : <?php echo $dat['S_Id']; ?></h6>
                                        <h6>Department : <?php echo $dat['dept']; ?></h6>
                                        <h6>Email      :<?php echo $dat['email']; ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                                <div class="card mt-5  text-center">
                                    
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
    
                                        <a href="mailto:<?php echo $dat['email']; ?>" class="btn btn-outline-dark"  style="width:80%;">Send Email</a>
                                        <br>                              
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                   </div>
    <?php 
                }
                else echo "Not available Under your Advisorship";
            }
            else {
                echo "Enter Student ID";
            }
           
        }

    ?>


</div> 

<br>
<?php 
    if(isset($_POST['subm'])){
        $sid = $_POST['sid']; ; 
        $msg = $_POST['msg'];
        $tid = $_SESSION['tid'];
        mysqli_query($con,"insert into message(sby,rby,seen,message) values('$tid','$sid','0','$msg')");
    }
?>
<br>

<div class="container text-center">
    <div class="text-center">
        <h4> Student List - My Advisorship</h4> <hr>
       
            <div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Department</th>
                            <th>Batch</th>
                            <th>Email</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                                    $tid = $_SESSION['tid'] ; 
                                    $qry = mysqli_query($con,"select * from advisor where T_Id = '$tid'");
                                    while($row = mysqli_fetch_array($qry)){
                                        $sid = $row['S_Id']; 
                                        $det = mysqli_query($con,"select * from student where S_Id = '$sid'");
                                        while( $rw =  mysqli_fetch_assoc($det)){
                            ?>
                                <tr>
                                    <td><?php echo $rw['S_Id']; ?></td>
                                    <td><?php echo $rw['S_name']; ?></td>
                                    <td><?php echo $rw['dept']; ?></td>
                                    <td><?php echo $rw['batch']; ?></td>
                                    <td><?php echo $rw['email']; ?></td>
                                    <td> 
                                        <form action="teacher_enrollment.php?sid=<?=$rw['S_Id']?>" method="post">
                                            <input type="hidden" name="sid" value="<?=$rw['S_Id']?>">
                                            <input type="submit" name="manage" value="Manage" class="btn btn-outline-success">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    
    
       
    </div>
</div>


<div class="text-center mt-5">
        <a href="teacher_advisorship.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>



</body>
</html>

