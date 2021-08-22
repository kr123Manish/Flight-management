<?php

$nerror="";
$merror="";
$aerror="";
if (array_key_exists("signup", $_POST)) {
   $link=mysqli_connect("sdb-e.hosting.stackcp.net","flight-3138337e65","Manish123","flight-3138337e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
    if (!$_POST['name']) {
       $nerror="Name is required<br>";
    }
    if (!$_POST['mob_no']) {
       $merror.="Mobile no is required<br>";
    }
    if (!$_POST['address']) {
       $aerror.="Address is required<br>";
    }
    else{
         $query="SELECT * FROM `customer` WHERE mob_no ='".mysqli_real_escape_string($link,$_POST['mob_no'])."' LIMIT 1";
         $result=mysqli_query($link,$query);//check email is avilable or not. 
         if(mysqli_num_rows($result)>0){
              $error="This Mobile Number is taken.";
            }
        else{
          // $error="You ready for login";
          $query="INSERT INTO `customer` (`name`,`mob_no`,`address`) VALUES('".mysqli_real_escape_string($link,$_POST['name'])."','".mysqli_real_escape_string($link,$_POST['mob_no'])."','".mysqli_real_escape_string($link,$_POST['address'])."')";

          $query1="INSERT INTO `ticket_detail` (`mob_no`) VALUES('".mysqli_real_escape_string($link,$_POST['mob_no'])."')";
          //query1 is inserted in ticket_detail so we assign ticket status and flight detail for that new customer.


             $result=mysqli_query($link,$query);
             $result1=mysqli_query($link,$query1);
             if($result>0 && $result1>0){
                $success="Data is inseted";

             }
             else{
              $error="Data does not inserted";
             }
        }
       
      }
    

}
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Fly With Us</title>

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
        font-family: sans-serif;
      }

      .container{
        text-align: center;
        margin-top:25vh;
      }
      /*#b1{
        margin-top:10px;
      }*/

      .x{
        margin-bottom:1rem;
      }
      
      #con{

        display: flex;
        justify-content:center;
        align-content: center;
        align-items: center;
      }

      a{
        font-size:1.1rem;
        color:green;
      }
      a:hover{
        color:yellow;
      }
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
      .success{
          width:25vw;
          color:green;
          font-weight:bold;
      }
    </style>
  </head>
  <body>
        
      <div class="container">
         <div class="error2"><?php echo $error; ?></div>
         
          <a href="admin.php" class="btn btn-success">Switch as Admin</a>
          <div id="con">
              <form id="csignup" method="post">
                  <h3>Register as a new Customer.</h3>
                    
                    <!-- <label>Name</label> -->
                    <div class="error"><?php echo $nerror; ?></div>
                    <input type="text" name="name" class="form-control x" placeholder="Name">
                    
                    
                    <!-- <label>Mobile No</label> -->
                    <div class="error"><?php echo $merror; ?></div>
                    <input type="INTEGER" name="mob_no" class="form-control x" placeholder="mobile no">
                    
                     
                    <!-- <label>Address</label> -->
                    <div class="error"><?php echo $aerror; ?></div>
                    <input type="text" name="address" class="form-control x" placeholder="Address">
                    
                    
                    
                    <input type="submit" name="signup" value="Sign up!" class="btn btn-primary" id="b1">
                    <p><a href="index.php" class="toggleform">login</a></p>
                    <div class="success"><?php if ($success) {
                        echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
                    } ?></div>
              </form>
            </div>
      </div>

    

     

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
     
      
  </body>
</html>