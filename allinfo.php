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
    <style>
          th, td {
            padding: 10px;
          }
    </style>
  
    <title>All Courses</title>
</head>
<body style="font-family: poppins;">

<h1> Course List : </h1> <br>
    <table >
        <tr>
            <th> Course Code </th>
            <th> Pre Course Code </th>
            <th> Credits </th>
        </tr>

        <?php 
            include("connection.php");

            $sql = "select * from courses";
            $r = mysqli_query($con,$sql);

            while ($row = mysqli_fetch_array($r)){
                ?>
                <tr>
                    <td> <?php  echo $row['cc'] ; ?> </td>
                    <td> <?php  echo $row['prec'] ; ?> </td>
                    <td> <?php  echo $row['credit'] ; ?> </td>
                </tr>
                <?php
            }
            ?>
    </table>
<br>

    <h1> Student List : </h1>


    <table >
        <tr>
            <th> Student Id </th>
            <th> Student name </th>
            <th> Password </th>
        </tr>

        <?php 
            include("connection.php");

            $sql = "select * from studnet";
            $r = mysqli_query($con,$sql);

            while ($row = mysqli_fetch_array($r)){
                ?>
                <tr>
                    <td> <?php  echo $row['S_Id'] ; ?> </td>
                    <td> <?php  echo $row['S_name'] ; ?> </td>
                    <td> <?php  echo $row['S_pass'] ; ?> </td>
                </tr>
                <?php
            }
            ?>
    </table>



    <h1> Teacher List : </h1>


<table >
    <tr>
        <th> Teacher Id </th>
        <th> Teacher name </th>
        <th> Password </th>
    </tr>

    <?php 
        include("connection.php");

        $sql = "select * from teacher";
        $r = mysqli_query($con,$sql);

        while ($row = mysqli_fetch_array($r)){
            ?>
            <tr>
                <td> <?php  echo $row['T_Id'] ; ?> </td>
                <td> <?php  echo $row['T_name'] ; ?> </td>
                <td> <?php  echo $row['T_pass'] ; ?> </td>
            </tr>
            <?php
        }
        ?>
</table>

<h1>Admin list : </h1>


<table >
    <tr>
        <th> Admin Id </th>
        <th> Admin name </th>
        <th> Password </th>
    </tr>

    <?php 
        include("connection.php");

        $sql = "select * from admin";
        $r = mysqli_query($con,$sql);

        while ($row = mysqli_fetch_array($r)){
            ?>
            <tr>
                <td> <?php  echo $row['A_Id'] ; ?> </td>
                <td> <?php  echo $row['A_name'] ; ?> </td>
                <td> <?php  echo $row['A_pass'] ; ?> </td>
            </tr>
            <?php
        }
        ?>
</table>

    


</body>
</html>

