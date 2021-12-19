<<?php
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
    <title>Admin Session</title>
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
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <div class="card text-center mt-4">
                <div class="card-header"> <h3 class="text-center"> Insert Session </h3> </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <label for="sname"> Session Name</label> <br>
                        <input type="text" name ="sname" required ><br><br>
                        <label for="syear"> Session Year</label> <br>
                        <input type="text" name ="syear" required><br><br> 

                       
                </div>
                <div class="card-footer">
                    <input type="submit" value="Add Session" name="sub" class="btn btn-primary" style="width:100%"><br>
                    </form>
                </div>

            </div>

                        <?php
                        include("connection1.php");

                        if( isset($_POST['sub'])){

                            $sess = $_POST['sname'];
                            $syr = $_POST['syear'];

                            $q = "insert into all_session values ('$sess','$syr')";

                            mysqli_query($con,$q);
                        }

                        ?>

        </div>
        <div class="col-lg-4">
            <div class="mt-5 btn btn-warning" style="width:100%">
                <h4> All Sessions </h4>
            </div>
            <div>
                <table class="table text-center">
                            <tr>
                                <th>Session</th>
                                <th>Year</th>
                            </tr>
                <?php
                    $qr = mysqli_query($con,"select * from all_session order by s_year desc"); 
                    while( $row = mysqli_fetch_array($qr) ) {
                        ?>
                            <tr>    
                                <td><?php echo $row['s_name'];?></td>
                                <td><?php echo $row['s_year'];?></td>
                            </tr>
                        <?php
                    }
                ?>
                </table>

            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <div class="text-center mt-5">
        <a href="admin_dashboard.php?logout=log" class="btn-lg btn-danger">LogOut</a>
    </div>


</div>

<div class="text-center py-3 mt-5 bg-dark text-white">
        <h6>Copyright © 2021 Premier University IT. All rights reserved.</h6>
</div>
       




</body>
</html>
