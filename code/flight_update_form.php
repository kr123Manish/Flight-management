<?php
session_start();
    $fno=$_SESSION['flight_no'];
    // echo $fno;
    
    $link=mysqli_connect("sdb-e.hosting.stagckcpp.net","flight-313833rt7e65","Password","flight-313833rt7e65");
    if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
      
    }else{
        // echo "connection succefull";
        $flight_detail="SELECT * FROM flight_detail WHERE flight_no='".mysqli_real_escape_string($link,$fno)."'";
        
        if($flight_result=mysqli_query($link,$flight_detail)){
         
            $row= mysqli_fetch_array($flight_result);
            
            $data="Departure time->".$row[0]."<br>"."Departure date->".$row[1]."<br>"."Arrival time->".$row[2]."<br>"."Arrival date->".$row[3]."<br>"."From city->".$row[4]."<br>"."To city->".$row[5]."<br>";

          }
         // Code for Update form.
         if(array_key_exists("submit_btn",$_POST)){
            //  echo "ready for update";
                    if(!$_POST['departure_time']){
                              
                              $fderror="Fill Departure Time for update"."<br>";
                          }
                          
                    if(!$_POST['arrival_time']){
                      
                      $faerror="Fill Arrival Time for update"."<br>";
                    }

                    if(!$_POST['from_city']){
                      $fferror="Fill From City for update"."<br>";
                     }

                    if(!$_POST['to_city']){
                      
                      $fterror="Fill To City for update"."<br>";
                    }
                    
                    else{
                      $query1="UPDATE `flight_detail` SET `departure_time`='".mysqli_real_escape_string($link,$_POST['departure_time'])."' WHERE flight_no= $fno";

                      $query2="UPDATE `flight_detail` SET `arrival_time`='".mysqli_real_escape_string($link,$_POST['arrival_time'])."' WHERE flight_no= $fno";

                      $query3="UPDATE `flight_detail` SET `from_city`='".mysqli_real_escape_string($link,$_POST['from_city'])."' WHERE flight_no= $fno";

                      $query4="UPDATE `flight_detail` SET `to_city`='".mysqli_real_escape_string($link,$_POST['to_city'])."' WHERE flight_no= $fno";

                      
                        $result=mysqli_query($link,$query1);
                        if($result>0){
                            $success="Departure Time Updated"."<br>";
                        }else{
                            $error.="Departure Time not Updated"."<br>";
                        }
                        
                        $result=mysqli_query($link,$query2);
                        if($result>0){
                            $success.="Arrival Time Updated"."<br>";
                        }else{
                            $error.="Arrival Time not Updated"."<br>";
                        }
                        
                        $result=mysqli_query($link,$query3);
                        if($result>0){
                            $success.="From City Updated"."<br>";
                        }else{
                            $error.="From City not Updated"."<br>";
                        }
                        
                        $result=mysqli_query($link,$query4);
                        if($result>0){
                            $success.="To City Updated"."<br>";
                        }else{
                            $error.="To City not Updated"."<br>";
                        }
                        
                       
                    }
         }else{
             // echo "not reay for update";
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

    <title>flight_update</title>
    <style type="text/css">
      .container{
        text-align: center;
        margin-top:3rem;
      }
      .form-control{
        width:50vw;
      }
      body{
        font-family: sans-serif;
      }

      .align{
        display: flex;
        justify-content: space-evenly;
        margin-bottom:0.5rem;
      }
      label{
        width:8vw;
        font-size:0.9rem;
        font-weight:bold;
        text-align:left;
        font-family: sans-serif;
      }
      .error{
        color: red;
        font-weight: bold;
      }
      .success{
        color: green;
        font-weight: bold;
        text-align:center;
        text-transform: uppercase;
        margin-left:auto;
        margin-right:auto;
        width:20vw;
        margin-top:1.5rem;
      }
      
      .x2{
          margin-top:60px;
          width:130px;
          margin-left: auto;
          margin-right: auto;
          
      }
}

</style>
  </head>
  <body>
    
    <div class="container">
        <div class="error"><?php echo $error; ?></div>
        <div class="success"><?php echo $success; ?></div>
      <h3>Flight Update form</h3>
      <form method="post">
        <div class="error"><?php echo $fderror; ?></div>
        <div class="align">
          <label>Departure Time</label>
          <input type="text" name="departure_time" class="form-control" placeholder="departure_time">
          <!-- <button type="submit" class="btn btn-success" name="departure_time_btn">Update</button> -->
        </div>

        <div class="error"><?php echo $faerror; ?></div>
        <div class="align">
          <label>Arrival Time</label>
          <input type="text" name="arrival_time" class="form-control" placeholder="arrival_time">
          <!-- <button type="submit" class="btn btn-success" name="arrival_time_btn">Update</button> -->
        </div>

        <div class="error"><?php echo $fferror; ?></div>
        <div class="align">
          <label>From City</label>
          <input type="text" name="from_city" class="form-control" placeholder="From city">
          <!-- <button type="submit" class="btn btn-success" name="from_city_btn">Update</button> -->
        </div>

        <div class="error"><?php echo $fterror; ?></div>
        <div class="align">
          <label>To City</label>
          <input type="text" name="to_city" class="form-control" placeholder="To city">
          <!-- <button type="submit" class="btn btn-success" name="to_city_btn">Update</button> -->
        </div>
        <button type="submit" class="btn btn-danger" name="submit_btn">Update</button>
      </form>  
      <div class="success"><?php if ($data) {
            echo '<div class="alert alert-success" role="alert">'.$data.'</div>';
      } ?></div>
    <a href="adminlandingpage.php" class="back btn btn-secondary x2">Back</a>
    </div>
    
    





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>
