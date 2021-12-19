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

    
    if( isset($_POST['sub'])){
        $sid = $_POST['sid'];
        $tid = $_POST['tid'];
        mysqli_query($con,"insert into advisor values ('$tid','$sid')");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    
    <title>Advisor Assign</title>
    <style>
        .first{
            border-radius : 20px;
            box-shadow : 1px 1px 10px gray ; 
        }
        a{
            text-decoration : none ; 
        }
    </style>

</head>
<body >

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

<h3 class="text-center my-5"> Advisor Assign </h3>
<div class="container">
    <div class="row">
    
        <div class="col-lg-6">
            <div class="card  text-center">
                <div class="card-header">
                    <h5> Assignment</h5> 
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <label for="sid">Student Name  </label> <br>
                        <select name="sid" style="width:80%" class="text-center">
                            <?php 
                                $query = mysqli_query($con,"select * from student where S_Id Not in (Select S_Id from advisor)");
                                while ($row = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php echo $row['S_Id']; ?> " > <?php  echo $row['S_name']; ?> </option>
                            <?php
                                }
                            ?>
                        </select> <br><br>

                        <label for="tid">Teacher Name  </label> <br>
                        <select name="tid" style="width:80%" class="text-center">
                            <?php
                                $query = mysqli_query($con,"select * from teacher");
                                while ($row = mysqli_fetch_array($query)){
                            ?>
                            <option value="<?php  echo $row['T_Id']; ?> "> <?php  echo $row['T_name']; ?> </option>
                            <?php
                                }
                            ?>
                        </select><br><br>
                   
                </div>
                <div class="card-footer">
                    <input type="submit" value="Assign" name="sub" style="width:80%" class="btn btn-outline-success text-center" >
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Student Without Advisor</h5> 
                </div>
                <div class="card-body">
                    <?php 
                        $query = mysqli_query($con,"select * from student where S_Id Not in (Select S_Id from advisor)");
                        if(mysqli_num_rows($query)){
                    ?>
                    <table class="table text-center"> 
                        <tr>
                            <th>Student Id </th>
                            <th>Student Name</th>
                        </tr>  

                    <?php 
                        while( $row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td> <?php echo $row['S_Id'] ; ?></td>
                            <td> <?php echo $row['S_name'] ; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <?php
                    }
                    else{
                    ?>
                        <h6 class="text-center">All Studnets have assigned Advisor.</h6>
                    <?php
                    } 
                    ?>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="text-center mt-5">
        <a href="admin_advisor_assign.php?logout=log" class="btn-lg btn-danger">LogOut</a>
</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       

        
</body>
</html>

