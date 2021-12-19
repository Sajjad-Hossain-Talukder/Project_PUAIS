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
    <title>All Courses</title>
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

<div class="container text-center mt-4">

    <div class="col-lg-12 text-center">
        <p class="display-4 mt-5">Offered Courses </p> 
    </div>

    <div class="card p-4">
    <form method="post" enctype="multipart/form-data" >
        <label for="session">  Select Session :  </label>
        <select name="session">
            <?php 
                $r = mysqli_query($con,"select * from all_session");
                while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo  $row['s_name']." ".$row['s_year']; ?>"><?php echo  $row['s_name']." ".$row['s_year']; ?></option>
                
            <?php
                }
            ?>
        </select> <br>
        <input type="submit" value="Show Offered Courses" name="show"  class="btn btn-outline-success mt-3">
    </form>
    </div>
<div class="container">
     <div class="row">
        <?php
            if( isset($_POST['show'])){
            $session = $_POST['session'];
            
            $r = mysqli_query($con, "select * from offered_courses where session_year = '$session'");
            while( $row = mysqli_fetch_array($r)){
                $cc = $row['course_code']; 

                $crs =  mysqli_query($con,"select * from courses where course_code = '$cc'");
                while($rowcrs = mysqli_fetch_array($crs)){
                    $sem =$rowcrs['sem'];
                    $cn = $rowcrs['course_name'];
                    $cd = $rowcrs['credit'];
                    $img = $rowcrs['image'];
                    $pre = $rowcrs['prereq_cc'];
                }

                $pc = mysqli_query($con,"select * from courses where course_code = '$pre'");
                while($rowc = mysqli_fetch_array($pc)){
                    $pren = $rowc['course_name'];
                }

                $sec = $row['section'];
                $tid = $row['T_Id'];

                $tec =  mysqli_query($con,"select * from teacher where T_Id = '$tid'");
                while($rowtec = mysqli_fetch_array($tec)){
                    $tname =$rowtec['T_name']; 
                }
        ?>
            <div class="col-lg-3">
                <div class="card mt-3">
                    <img src="uploaded_images/<?php echo $img;?>" class="card-img-top img-fluid" > <br>

                    <h4><?php echo $cn; ?></h4>
                    <h5><?php echo $cc; ?></h5><br>
                    <hr>
                    <h6>Semester :<?php echo $sem; ?> </h6>
                    <h6>Section : <?php echo $sec; ?></h6>
                    <h6>Credit : <?php echo $cd; ?></h6>
                    <h6>Pre-Title : <?php echo $pren ; ?></h6>
                    <h6>Instructor : <?php echo $tname ; ?></h6>
                
                </div>
            </div>
                
        <?php
            }
        }
        ?>
    
        </div>
    </div> 
    </div>
</div>

</div>


<br>


<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="display-4 mt-5"> All Courses List </p> <hr>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table text-center">
                    <tr>	
                        <th>Semester</th>
                        <th>Course Code </th> 
                        <th>Course Name </th> 
                        <th>Pre-requisite Course Code</th>
                        <th>Credits</th>
                    </tr>
                <?php
                    $r = mysqli_query($con,"select * from courses where credit > 0 order by sem_n ");
                    while($row = mysqli_fetch_array($r)){
                ?>
                    <tr>
                        <td><?php echo $row['sem'];?></td>
                        <td><?php echo $row['course_code']; ?></td>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['prereq_cc']; ?></td>
                        <td><?php echo $row['credit']; ?></td>
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
</div>




<div class="text-center mt-5">
        <a href="admin_dashboard.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       

    

</body>

</html>