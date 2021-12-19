<?php
session_start();
//cart code 

if ( isset($_POST['add'])){
    if( isset($_SESSION['cart']) ){

        echo "Hola!!!!" ;

        $item_array_id = array_column($_SESSION['cart'],'item_id');
        if(!in_array($_GET['id'],$item_array_id)){
            $count = count($_SESSION['cart']);
            $item_array = array('item_id' => $_GET['id'],
                'item_name' => $_POST['hname'],
                'item_price'=> $_POST['hprice'],
                'item_q' => $_POST['quantity'],
        );

        $_SESSION['cart'][$count] =  $item_array ;

        }

        //else {
            //echo "<script>alert('Item Added Alred')</script>";
        //    echo "<script>window.location='1_cart.php'</script>";
       // }
    }
    else {
        $item_array = array('item_id' => $_GET['id'],
                'item_name' => $_POST['hname'],
                'item_price'=> $_POST['hprice'],
                'item_q' => $_POST['quantity'],
        );
        $_SESSION['cart'][0] =  $item_array ;
    }
}

// item remove 

if ( isset($_GET['action']) and $_GET['action'] == 'delete' ){
    foreach($_SESSION['cart'] as $keys => $values ){
        if($values['item_id'] == $_GET['id']){
            unset($_SESSION['cart'][$keys]);
        }
    }
}
?>

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
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <style>
        th,td{
            padding:10px;
            margin : 10px;
            text-align : center;
        }
    </style>
    
    <title>Cart</title>
</head>
<body>

<form action='1_cart.php?action=add&id=$course_code' method='post'>

    <table>
        <tr>
            <th>Semester</th>
            <th>Course Code</th>
            <th>Course Title</th>
            <th>Section</th>
            <th>Credit</th>
            <th>Teacher Name </th>
            <th>Course Type </th>
            <th>Action</th>
        </tr>

       
        <?php
        include("connection.php");

        $sql = "select * from offered_courses" ; 
        $q = mysqli_query($con,$sql);

        while( $row = mysqli_fetch_array($q)){
            
            $semester	 = $row['semester'];
            $course_code	 = $row['course_code'];
            $course_name	 = $row['course_name'];
            $section	 = $row['section'];
            $session_year	 = $row['session_year'];
            $prereq_code	 = $row['prereq_code'];
            $credit	 = $row['credit'];
            $T_name = $row['T_name'];
        ?>

            <tr>
                <td> <?php echo $semester; ?></td>
                <td> <?php echo $course_code; ?></td>
                <td> <?php echo $course_name; ?></td>
                <td> <?php echo $section; ?></td>
                <td> <?php echo $credit; ?></td>
                <td> <?php echo $T_name; ?></td>
                <td> 
                   <input type='text' value='1' name='course_type'>
                    <input type='hidden' name='hidden_name' value='<?php echo $row["course_code"]; ?>' />  
                    <input type='hidden' name='hidden_price' value='<?php echo $row["section"]; ?>' />  
                </td>
                <td>
                    <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="add" />  
                </td>
                </tr>
            


    <?php
        }
    ?>
    </table>
    
</form>


<script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
</body>
</html>
