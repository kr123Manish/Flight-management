<?php
session_start();
    $cno=$_SESSION['mob_no'];
    
  // echo $cno;
    $link=mysqli_connect("sdb-e.hosting.stagckcpp.net","flight-313833rt7e65","password","flight-313833rt7e65");
   if (mysqli_connect_error()) {
      // echo "There was an error to connecting to the database";
      die("Database Connection Error");
    }
  else{
    // For previous data.
    // costomer result.
    // echo "Connestion success";
    $query2="SELECT * FROM `customer` WHERE mob_no='".mysqli_real_escape_string($link,$cno)."'";
        $row2="";
        if($customer_result=mysqli_query($link,$query2)){
                $row=mysqli_fetch_array($customer_result);
                 $data="Your Name is ->".$row[2]."<br>"."Your Mobile no is ->".$row[0]."<br>"."Your address is ->".$row[1]."<br>";
                 }
    // code for ticket detail.

          $ticket_detail="SELECT * FROM `ticket_detail` WHERE mob_no='".mysqli_real_escape_string($link,$cno)."'";
            if($ticket_result=mysqli_query($link,$ticket_detail)){
              $row2=mysqli_fetch_array($ticket_result);
              $data.="Your booking_status is->".$row2[0]."<br>"."Your payment is->".$row2[2]."<br>"."Your pnr is ->".$row2[3]."<br>"."Your seat detail is->".$row2[4]."<br>"."Your flight no is ->".$row2[5]."<br>";
            }

    // code for flight detail
            $flight_detail="SELECT * FROM `flight_detail` WHERE `flight_no`=$row2[5]";
            if($flight_result=mysqli_query($link,$flight_detail)){
              $row3=mysqli_fetch_array($flight_result);
              $data.="Your flight from city ->".$row3[4]."<br>";
            }
            //------------------------------------------------------------------------------//
            // for update booking status
            if (array_key_exists("ubooking_status_btn", $_POST)) {
                // echo "Ready for update";
                if(!$_POST['ubooking_status']){
                    $fberror="Fill Booking Status for update";
                }else{
                    // $error="Your value ready for update";
                    $query="UPDATE `ticket_detail` SET `booking_status`='".mysqli_real_escape_string($link,$_POST['ubooking_status'])."' WHERE mob_no= $cno";
                    $result=mysqli_query($link,$query);
                    if($result>0){
                        $success="Booking Status is updated successfully";
                    }else{
                        $error="Booking Status does not updated";
                    }
                }
            }
            
            //------------------------------------------------------------------------------------------//
                  // for update payment status.
                  if (array_key_exists("upayment_status_btn", $_POST)) {
                      // echo "Ready for update";
                      if(!$_POST['upayment_status']){
                          $fperror="Fill Payment Status for update";
                      }else{
                          // $error="Your value ready for update";
                          $query="UPDATE `ticket_detail` SET `payment`='".mysqli_real_escape_string($link,$_POST['upayment_status'])."' WHERE mob_no= $cno";
                          $result=mysqli_query($link,$query);
                          if($result>0){
                              $success="Payment Status is updated successfully";
                          }else{
                              $error="Payment does not updated";
                          }
                      }
                  }
            //------------------------------------------------------------------------------------------//
                  // for update PNR
                  if (array_key_exists("upnr_btn", $_POST)) {
                      // echo "Ready for update";
                      if(!$_POST['upnr']){
                          $fPerror="Fill PNR Status for update";
                      }else{
                          // $error="Your value ready for update";
                          $query="UPDATE `ticket_detail` SET `pnr`='".mysqli_real_escape_string($link,$_POST['upnr'])."' WHERE mob_no= $cno";
                          $result=mysqli_query($link,$query);
                          if($result>0){
                              $success="PNR Status is updated successfully";
                          }else{
                              $error="PNR does not updated";
                          }
                      }
                  }
            //------------------------------------------------------------------------------------------//
                  // for update seat detail
                  if (array_key_exists("useat_detail_btn", $_POST)) {
                      // echo "Ready for update";
                      if(!$_POST['useat_detail']){
                          $fserror="Fill Seat Detail for update";
                      }else{
                          // $error="Your value ready for update";
                          $query="UPDATE `ticket_detail` SET `seat_detail`='".mysqli_real_escape_string($link,$_POST['useat_detail'])."' WHERE mob_no= $cno";
                          $result=mysqli_query($link,$query);
                          if($result>0){
                              $success="Seat Detail is updated successfully";
                          }else{
                              $error="Seat Detail does not updated";
                          }
                      }
                  }
                  
        
                // for update flight detail.

                // if (array_key_exists("uflight_no_btn", $_POST)) {
                //     // echo "Ready for update";
                //     if(!$_POST['uflight_no']){
                //         $error="Fill Flight Number for update";
                //     }else{
                //         // $error="Your value ready for update";
                //         $query="UPDATE `ticket_detail` SET `flight_no`='".mysqli_real_escape_string($link,$_POST['uflight_no'])."' WHERE mob_no= $cno";
                //         $result=mysqli_query($link,$query);

                //         $query3="INSERT INTO `flight_detail` (`flight_no`) VALUES('".mysqli_real_escape_string($link,$_POST['uflight_no'])."')";
                //         $result2=mysqli_query($link,$query3);
                //         //query3 is inserted in flight_detail so we assign flight detail for that new customer.
                //         if($result>0){
                //             $error="Flight Number is updated successfully";
                //         }else{
                //             $error="Flight Number does not updated";
                //         }
                //     }
                //   }
                
                if (array_key_exists("uflight_no_btn", $_POST)) {
                    // echo "Ready for update";
                    if(!$_POST['uflight_no']){
                        $fnerror="Fill Flight Number for update";
                    }else{
                        // $error="Your value ready for update";
                        $query="UPDATE `ticket_detail` SET `flight_no`='".mysqli_real_escape_string($link,$_POST['uflight_no'])."' WHERE mob_no= $cno";
                        $result=mysqli_query($link,$query);

                        
                        if($result>0){
                            $success="Flight Number is updated successfully";
                        }else{
                            $error="Flight Number does not updated";
                        }
                    }
                  }
              //------------------------------------------------------------------------------------------//

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

    <title>customer_update</title>
    <style type="text/css">
      .container{
        text-align: center;
      }
      .form-control{
        width:50vw;
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
      h3{
          margin-bottom:1rem;
      }
      .error{
          color:red;
          font-weight:bold;
      }
      .error2{
          color:red;
          font-weight:bold;
      }
      .success{
        color: green;
        font-weight: bold;
        text-align:center;
        text-transform: uppercase;
        margin-left:auto;
        margin-right:auto;
        width:24vw;
        margin-top:1.5rem;
      }
      
      .x2{
          margin-top:50px;
          width: 130px;
          
          
      }

</style>
  </head>
  <body>
    
    <div class="container">
      <div class="error2"><?php echo $error; ?></div>
      <div class="success"><?php echo $success; ?></div>
      <h3>Customer Update form</h3>
      <form method="post">
        <div class="error"><?php echo $fberror; ?></div>
        <div class="align">
          
          <label>Booking Status</label>
          <input type="text" name="ubooking_status" class="form-control" placeholder="booking_status">
          <button type="submit" class="btn btn-success" name="ubooking_status_btn">Update</button>
          
        </div>

        <div class="error"><?php echo $fperror; ?></div>
        <div class="align">
          
          <label>Payment Status</label>
          <input type="text" name="upayment_status" class="form-control" placeholder="payment_status">
          <button type="submit" class="btn btn-success" name="upayment_status_btn">Update</button>
        </div>

        <div class="error"><?php echo $fPerror; ?></div>
        <div class="align">
          
          <label>PNR Status</label>
          <input type="text" name="upnr" class="form-control" placeholder="PNR">
          <button type="submit" class="btn btn-success" name="upnr_btn">Update</button>
        </div>

        <div class="error"><?php echo $fserror; ?></div>
        <div class="align">
          
          <label>Seat Detail</label>
          <input type="text" name="useat_detail" class="form-control" placeholder="seat_detail">
          <button type="submit" class="btn btn-success" name="useat_detail_btn">Update</button>
        </div>

        <div class="error"><?php echo $fnerror; ?></div>
        <div class="align">
          
          <label>Flight No</label>
          <input type="text" name="uflight_no" class="form-control" placeholder="flight_no">
          <button type="submit" class="btn btn-success" name="uflight_no_btn">Update</button>
        </div>
        <div class="success"><?php if ($data) {
                    echo '<div class="alert alert-success" role="alert">'.$data.'</div>';
                }?>
        </div> 
        </form>

        <a href="adminlandingpage.php" class="back btn btn-secondary x2">Back</a>
           
    </div>
    





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    
  </body>
</html>
