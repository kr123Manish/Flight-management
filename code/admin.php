<?php


if (array_key_exists("login", $_POST)) {
   $link=mysqli_connect("sdb-e.hosting.stackcp.net","flight-3138337e65","Manish123","flight-3138337e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
    if (!$_POST['name']) {
       $nerror="Name is required<br>";
    }
    if (!$_POST['mob_no']) {
       $merror="Password is required<br>";
    }
    else{
          
        $query="SELECT * FROM `admin` WHERE name='".mysqli_real_escape_string($link,$_POST['name'])."'";
        $query2="SELECT * FROM `admin` WHERE pass='".mysqli_real_escape_string($link,$_POST['mob_no'])."'";

        $result=mysqli_query($link,$query);
        $result2=mysqli_query($link,$query2);
        if(mysqli_num_rows($result)>0 && mysqli_num_rows($result2)>0){
            //$error="We found you.";
            // code for desplay data of flight detail
            header("Location: adminlandingpage.php");
          }
        else{
            $error="Admid could not found!";
          }
      }
    

}
?>



<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Admin_Page</title>
    <style type="text/css">
      html { 
        background: url(bg.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

    body{
        background: none;
        font-family:sans-serif;
      }

      .container{
        text-align: center;
        margin-top:25vh;
      }

      #con{

        display: flex;
        justify-content:center;
        align-content: center;
        align-items: center;
      }

      .x{
        margin-bottom:1rem;
        width:20vw;
      }
      /*#b1{
        margin-top:1rem;
      }*/
      h3{
          margin-bottom:1rem;
      }
      .error{
          color:yellow;
          font-weight:bold;
      }
      .error2{
          color:red;
          font-weight:bold;
      }
     
    </style>
  </head>
  <body>
    <div class="container">
      <div class="error2"><?php echo $error; ?></div>
      <a href="index.php" class="btn btn-success">Switch as Cutomer</a>
      <h3>Login as Admin</h3>
        <div id="con">
          
            <form method="post">
                <div class="error"><?php echo $nerror; ?></div>
                <input type="text" name="name" class="form-control x" placeholder="name">
                
                <div class="error"><?php echo $merror; ?></div>
                <input type="password" name="mob_no" class="form-control x" placeholder="password">
                
                <input type="Submit" name="login" value="Log in" class="btn btn-primary" id="b1">
          </form>
        </div>

    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>