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
        .container{
            border-radius : 20px;
            box-shadow : 1px 1px 10px gray;
        }
    </style>
    <title>Admin</title>
    
</head>

<body>

<div class="container p-4" style="margin-top:200px;">
    <div class="row">
        <div class="col-lg-4" style="border-right:2px solid black;" >

                <div class="row text-center">
                    <div class="col-lg-5 my-5"  >
                        <img src="images/puc.png" class="img-fluid">
                    </div>
                    <div class="col-lg-7">
                       
                        <a href="index.php" style="text-decoration: none;color: rgb(5, 2, 12);"> <h1 class="text-center my-5">Premier University </h1> </a> 
                    </div>
                </div>
           
        </div>
        <div class="col-lg-8"  >
            <div class="row">
                <div class="col-lg-12">
                    <div class="display-3 text-center">
                        <a href="index.php" style="text-decoration: none;color: rgb(5, 2, 12);">P  U  A  I  S </a> 
                        <h4>A D M I N</h4>
                        <hr>
                    </div>
                </div>
                <div class="col-lg-12 text-center my-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="admin_resister.php" class="btn btn-outline-dark" style="width:16rem;"><h4>Resister</h4></a>      
                        </div>
                        <div class="col-lg-6">
                        <a href="admin_login.php" class="btn btn-outline-dark" style="width:16rem;"><h4>Login</h4></a>     
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>




</body>

</html>