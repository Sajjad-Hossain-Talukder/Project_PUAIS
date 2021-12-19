<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Roboto&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <title>Courses</title>
    <style>
        th,td{
            width:150px;
            text-align:center;
            border:1px solid black;
            padding:5px
        }
    </style>
</head>
<body >

    <form method="post" enctype="multipart/form-data">

        <label for="cc"> Course Name  :  </label>
        <select name="cc">
            <?php 
            include("connection.php");
            $r = mysqli_query($con,"select * from courses");
            while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo $row['course_code']; ?>"><?php echo $row['course_name']; ?></option>
            
            <?php
            }
            ?>
        </select>

        <br>

        <label for="sess"> Session :  </label>
        <select name="sess">
            
            <?php 
            include("connection.php");

            $r = mysqli_query($con,"select * from all_session");

            while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo $row['session_year']; ?>"><?php echo $row['session_year']; ?></option>
            
            <?php
            }
            ?>

        </select>



        <br>

        <label for="sec"> Section :  </label>
        <select name="sec">
            
            <?php 
            include("connection.php");

            $r = mysqli_query($con,"select * from all_section");

            while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo $row['section']; ?>"><?php echo $row['section']; ?></option>
            
            <?php
            }
            ?>

        </select>

       
        <br>

        <label for="tid"> Course Teacher :  </label>
        <select name="tid">
            
            <?php 
            include("connection.php");

            $r = mysqli_query($con,"select * from teacher");

            while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo $row['T_Id']; ?>"><?php echo $row['T_name']; ?></option>
            
            <?php
            }
            ?>

        </select>

       
        <br>
        

        <input type="submit" value="Add" name="sub"><br>


    </form>


    <br><br>



   
    <br>
    <br>
    <br>
    <h3>Offered Courses </h3>


    <form method="post" enctype="multipart/form-data" >
    <label for="selsess">  Select Session :  </label>
    <select name="selsess">
            
            <?php 
            include("connection.php");

            $r = mysqli_query($con,"select * from all_session");

            while( $row = mysqli_fetch_array($r) ){
            ?>
                <option value="<?php echo $row['session_year']; ?>"><?php echo $row['session_year']; ?></option>
            
            <?php
            }
            ?>
    </select>

    <input type="submit" value="Show Offered Courses" name="show" >
    </form>

    <br>
    <br>


    <?php
        include("connection.php");
        if( isset($_POST['show'])){
            $selsess = $_POST['selsess'];
            $q = "select * from offered_courses where session_year = '$selsess'";
            $r = mysqli_query($con,$q);
    ?>

    <table>
        <tr>	
            <th>Semester</th>
            <th>Course Code </th> 
            <th> Course Name </th> 
            <th> Section </th> 
            <th>Prerequisite Course Code</th>
            <th>Credits</th>
            <th>Course Teacher</th>
        </tr>
        <?php
        while($row = mysqli_fetch_array($r)){
        ?>
            <tr>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['course_code']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['prereq_code']; ?></td>
                <td><?php echo $row['credit']; ?></td>
                <td><?php echo $row['T_name']; ?></td>
            </tr>

        <?php
        }
        ?>

    </table>


    <?php
        }
    ?>



</body>
</html>


<?php
include("connection.php");

if( isset($_POST['sub'])){

    $cc = $_POST['cc'];
    $sec = $_POST['sec'];
    $sess = $_POST['sess'];
    $tid = $_POST['tid'];

    $q = "select * from courses where course_code = '$cc'";
    $r = mysqli_query($con,$q);
    while ( $row = mysqli_fetch_array($r)){
    $sm = $row['semester'];
    $cn = $row['course_name'];
    $prec = $row['prereq_course_code'];
    $cdt = $row['credit'];
    }

    $q = "select * from teacher where T_Id = '$tid'";
    $r = mysqli_query($con,$q);
    while ( $row = mysqli_fetch_array($r)){
    $tname = $row['T_name'];
    }


  
    $q = "insert into offered_courses values ('$sm','$cc','$cn','$sec','$sess','$prec','$cdt','$tid','$tname')";

    mysqli_query($con,$q);
    
}

?>
