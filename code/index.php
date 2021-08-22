<?php

$merror="";
$nerror="";
$data="";
if (array_key_exists("login", $_POST)) {
   $link=mysqli_connect("sdb-e.hosting.stackcp.net","flight-3138337e65","Manish123","flight-3138337e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
    if (!$_POST['name']) {
       $nerror="Name is required!";
    }
    if (!$_POST['mob_no']) {
       $merror="Mobile no is required!";
    }
    else{
          
        $query="SELECT * FROM `customer` WHERE name='".mysqli_real_escape_string($link,$_POST['name'])."'";
        $query2="SELECT * FROM `customer` WHERE mob_no='".mysqli_real_escape_string($link,$_POST['mob_no'])."'";

        $result=mysqli_query($link,$query);
        $result2=mysqli_query($link,$query2);
        if(mysqli_num_rows($result)>0 && mysqli_num_rows($result2)>0){
            // $data="We found you.";
            $row2="";
           // code for customer detail.
            
            
            if($customer_result=mysqli_query($link,$query2)){
                $row=mysqli_fetch_array($customer_result);
                 $data.= "Your Name is :->".$row[2]."<br>"."Your Mobile no is :->".$row[0]."<br>"."Your address is :->".$row[1]."<br>";
                 }
          // code for ticket detail.

          $ticket_detail="SELECT * FROM `ticket_detail` WHERE mob_no='".mysqli_real_escape_string($link,$_POST['mob_no'])."'";
            if($ticket_result=mysqli_query($link,$ticket_detail)){
              $row2=mysqli_fetch_array($ticket_result);
              $data.="Your booking_status is :->".$row2[0]."<br>"."Your payment is :->".$row2[2]."<br>"."Your pnr is :->".$row2[3]."<br>"."Your seat detail is :->".$row2[4]."<br>"."Your flight no is :->".$row2[5]."<br>";
            }
            
            //code for flight detail
               
            $flight_detail="SELECT * FROM `flight_detail` WHERE `flight_no`=$row2[5]";
            if($flight_result=mysqli_query($link,$flight_detail)){
              $row3=mysqli_fetch_array($flight_result);
              $data.="Your flight from city :->".$row3[4];
            }

          }
        else{
            $error="Customer did not found";
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
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
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
        margin-top:15vh;
      }
     
      /*#b2{*/
      /*  margin-top:px;*/
      /*}*/
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
      .data{
          width:400px;
          text-transform: uppercase; 
          font-weight:bold;
          text-align:left;
      }
      small{
         
          color: red;
          font-weight: bold;
          text-transform: lowercase; 
      }
      
      .back-btn{
          color: blue;
          font-size: 15px;
          font-weight: bold;
      }
      
      .back-btn:hover{
          color:black;
          text-decoration:none;
          
      }
      
    </style>
  </head>
  <body>
        
      <div class="container">
         <div class="error2"><?php echo $error; ?></div>
         
          <a href="admin.php" class="btn btn-success">Switch as Admin</a>
          <div id="con">
              <form id="clogin" method="post">
                  <h3>Login registered customer.</h3>
                  <!-- <label>Name</label> -->
                  <div class="error"><?php echo $nerror; ?></div>
                  <input type="text" name="name" class="form-control x" placeholder="Name">

                  <!-- <label>Mobile No</label> -->
                  <div class="error"><?php echo $merror; ?></div>
                  <input type="INTEGER" name="mob_no" class="form-control x" placeholder="mobile no">
                      
                  <input type="submit" name="login" value="Login!" class="btn btn-primary" id="b2">
                  

                  <p><a href="customersignup_page.php" class="toggleform">sign up</a></p>
                  <div class="data"><?php if($data){
                                            echo '<div class="alert alert-success" role="alert">'.$data.'<br><small>If data is does not shown means admin <br>needs to update your request</small>
                                                <a href="index.php" class ="back-btn">Exit</a></div>';
                                            
                                                }
                                            ?>
                  </div>
                  
              </form>
            </div>
      </div>

    

     

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaR
kfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
 
      
  </body>
</html>