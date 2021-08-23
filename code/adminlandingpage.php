<?php

// code for flight detail
if (array_key_exists("fsub", $_POST)) {
   $link=mysqli_connect("sdb-e.hosting.stagckcpp.net","flight-313833rt7e65","Password","flight-313833rt7e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
    if (!$_POST['fno']) {
       $fnerror="Flight Number is required<br>";
    }
    
    else{
          
        $query="SELECT * FROM `flight_detail` WHERE flight_no='".mysqli_real_escape_string($link,$_POST['fno'])."'";
       

        $result=mysqli_query($link,$query);
        
        if(mysqli_num_rows($result)>0){
            $success="We found the flight.";
            // code for desplay data of flight detail
            session_start();
            $_SESSION['flight_no'] = $_POST['fno'];
             header("Location: flight_update_form.php");
           
          }
        else{
            $error="This flight could not found";
          }
      }
    

}

// code for customer detail
if (array_key_exists("csub", $_POST)) {
   $link=mysqli_connect("sdb-e.hosting.stackcp.net","flight-3138337e65","Manish123","flight-3138337e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
    if (!$_POST['cno']) {
       $cnerror="Customer Number is required<br>";
    }
    
    else{
          $query2="SELECT * FROM `customer` WHERE mob_no='".mysqli_real_escape_string($link,$_POST['cno'])."'";
          $result2=mysqli_query($link,$query2);

        if(mysqli_num_rows($result2)>0){
            
            $success="We found you.";
            session_start();
            $_SESSION['mob_no'] = $_POST['cno'];
            header("Location: customer_update_form.php");
            
            
         }
        else{
            $error="That customer not found";
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
      }


    #fdetail,#cdetail{
      display: none;
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


      .y{
        margin-left: 1rem;

      }
      .x{
        margin-right: 2rem;
      }
      .x2{
          margin-top:50px;
          width: 80px;
          
          
      }
      .imgcus{
        width:26vw;
        margin:1rem;
      }
      .imgfl{
        width:23vw;
      }
     img{
      border: 5px solid #FFFD8C;
      margin-bottom:0.5rem;
     }

     .imgfl2{
      width:35vw;
      margin-top:-15vh;
     }

     .imgf3{
      width:35vw;
      margin-top:-15vh;
     }
     .form-control{
      width:28vw;
      margin-bottom:0.5rem;
      margin-left:auto;
      margin-right:auto;
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
      <div class="error2"><?php echo $fnerror; ?></div>
      <div class="error2"><?php echo $cnerror; ?></div>

        <div id="con">
              
              <div class="imgfl">
                <img src="fd.jpg" class="img-fluid">
                <input type="submit" name="fsearch" value="Flight detail" id="fldetail" class="btn btn-danger y">
              </div>
              <div class="imgcus">
                <img src="cus.jpg" class="img-fluid">
                <input type="submit" name="csearch" value="customer detail" id="codetail" class="btn btn-info y">
              </div>
              
            

            <form id="fdetail"  method="post">
              <div class="imgfl2">
                <img src="fd.jpg" class="img-fluid">
              <div class="error2"><?php echo $fnerror; ?></div>
              <input type="text" name="fno" placeholder="Flight No" class="form-control">
             
              <input type="submit" name="fsub" value="search" class="btn btn-success x">
              <!-- <input type="submit" name="backf" value="Update" class="back btn btn-danger x"> -->
              <input type="submit" name="backf" value="back" class="back btn btn-warning x up">
            </div>
            </form>

            <form id="cdetail"  method="post">
             <div class="imgf3">
              <img src="cus.jpg" class="img-fluid">
              <div class="error2"><?php echo $cnerror; ?></div>
              <input type="text" name="cno" placeholder="Customer Mobile No" class="form-control">
            
              <input type="submit" name="csub" value="search" class="btn btn-success x">
              <!-- <input type="submit" name="backf" value="Update" class="back btn btn-danger x up"> -->
              <input type="submit" name="backf" value="back" class="back btn btn-warning x">
            </div>
            </form>
           

        </div>
     <a href="index.php" class="back btn btn-secondary x2">Exit</a>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

      <script type="text/javascript">
    $("#fldetail").click(function(){
          $("#fdetail").toggle();
          // $("#fldetail").toggle();
          // $("#codetail").toggle();
          $(".imgfl").toggle();
          $(".imgcus").toggle();
        })  

    $("#codetail").click(function(){
          $("#cdetail").toggle();
          // $("#fldetail").toggle();
          // $("#codetail").toggle();
          $(".imgfl").toggle();
          $(".imgcus").toggle();
        })  

    $(".back").click(function(){
      $("#fldetail").toggle();
        $("#codetail").toggle();
        $(".back").toggle();
    })

   
  </script>

    
  </body>
</html>
