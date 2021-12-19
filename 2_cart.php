<?php

include("connection.php");

session_start();



if ( isset($_SESSION['sid']) and $_SESSION['logged_in_status'] == true  ){   
    if( @$_GET['logout'] == true ){
        session_destroy();
        header('location:index.php');
    }
}
else header('location:index.php');





if ( isset($_POST['remove']) ){
    $cc = $_GET['code'] ;  
    $sid = $_SESSION['sid'];
    $sec = $_POST['sec'];
    $que = "delete from enrollment where course_code = '$cc' and S_Id = '$sid' and flag='0' and section = '$sec'" ;
    mysqli_query($con,$que);
}



if ( isset($_POST['enroll'])){

    $cc = $_GET['cc'] ;  
    $sid = $_SESSION['sid'];
    $sess =  $_POST['sess'] ; 
    $c_name = $_POST['c_name'] ;
        
    $type = $_POST['enroll_type'] ;
    $section =  $_POST['section'];
    $credit =  $_POST['credit'];
    $semester =  $_POST['sem'];
    $semestern =  $_POST['semn'];

    $q = "select * from enrollment where S_Id = '$sid' and  course_code = '$cc' and section = '$section' ";
    $row = mysqli_query($con,$q);

    if (mysqli_fetch_assoc($row)){
        
    }
    else {
        $sql = "insert into enrollment values('$semestern','$semester','$sid','$cc','$c_name' , '$section' ,'$sess' , '$type' ,'0')";
        mysqli_query($con,$sql);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <head>
</head>


<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="text-center">Courses </h2>
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            
                                $sql = "select * from offered_courses , courses where courses.course_code = offered_courses.course_code " ; 
                                $q = mysqli_query($con,$sql);

                                while($row = mysqli_fetch_array($q)){
                        
                            ?>
                            <div class="col-md-3">
                                <form method="post" action="2_cart.php?cc=<?=$row['course_code']?>" > 

                                   
                                    
                                    <div class="card mt-5" >
                                        <img class="card-img-top img-fluid" src="uploaded_images/<?=$row['Course_image']?>" alt="Card image cap">
                                        <div class="card-body text-center">
                                                <div style="height:100px;">
                                                       <h5 class="card-title"  > <?=$row['course_name']?> </h5>
                                                </div>
                                            <br>
                                            <h6 class="card-text" >Course Code : <?=$row['course_code']?></h6>
                                            <h6 class="card-text" >Semester : <?=$row['semester']?></h6>
                                            <h6 class="card-text" >Section : <?=$row['section']?></h6>
                                            <h6 class="card-text" >Credits : <?=$row['credit']?></h6>
                                            <h6 class="card-text" >Course Teacher  :   <?=$row['T_name']?></h6>
                                            <br>
                                            <h6 class="card-text" >Course Type : </h6>
                                            <h6>
                                            <select name="enroll_type" id="enroll_type" class="form-control">
                                                <option value="Regular">Regular</option>
                                                <option value="Retake">Retake</option>
                                                <option value="Recourse">Recourse</option>
                                               
                                            </select>
                                            </h6>
                                            <input type="hidden" name="c_code" value="<?=$row['course_code']?>">
                                            <input type="hidden" name="c_name" value="<?=$row['course_name']?>">
                                            <input type="hidden" name="sid" value="<?=$_SESSION['sid']?>">
                                            <input type="hidden" name="section" value="<?=$row['section']?>">
                                            <input type="hidden" name="sess" value="<?=$row['session_year']?>">
                                            <input type="hidden" name="credit" value="<?=$row['credit']?>">
                                            <input type="hidden" name="semn" value="<?=$row['semester_n']?>">
                                            <input type="hidden" name="sem" value="<?=$row['semester']?>">

                                            

                                            
                                           
                                   
                                        </div>
                                        <div class="card-footer">

                                            <p class="text-center"><input type="submit" class="btn btn-primary btn-block my-2" name="enroll" value="Enroll Course"></p>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <?php        
                                }
                            ?>
                        </div>
                    </div>
                </div>
                


                <div class="col-md-4">
                    <h2 class="text-center">Enrolled Courses</h2>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>

                                <th scope="col">Course Name</th>
                                <th scope="col">Section</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                                </tr>

                            </thead>
                            <tbody>

                                <?php 
                                    $sid = $_SESSION['sid'] ;
                                    $qr = "select * from enrollment where flag = '0' and S_Id = '$sid' order by semester";
                                    $allrow = mysqli_query($con,$qr);

                                    while( $row = mysqli_fetch_array($allrow)){
                                ?>
                                        
                                        <tr>

                                            <td><?php echo $row['course_name']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <form action=""></form>
                                            <td>
                                                <form method="post" action="2_cart.php?code=<?=$row['course_code']?>" > 
                                                <input type="hidden" name="sec" value="<?=$row['section']?>">
                                                <input type="submit" name="remove" value="Remove" class="btn btn-danger">
                                                </form>
                                            
                                            </td>
                                            
                                        </tr>

                                <?php
                                    }
                                ?>

                                
                                
                            </tbody>
                        </table>
                    </div>

                    <div>
                            
                        <a href="student_payment_details.php" class="btn btn-success btn-lg btn-block" style="width:100%;" >Confirm</a>
                        

                    </div>

                </div>
            </div>
        </div>
    </div>


    
    <a href="2_cart.php?logout=log">LogOut</a>

</body>

</html>

