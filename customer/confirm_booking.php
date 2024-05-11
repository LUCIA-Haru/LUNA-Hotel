<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNA</title>
    <?php require('./files/links.php') ?>

</head>
<body>
<!-- Header links -->
<?php require('files/header.php');?>
<!-- Check room is from url is present or not
        Shutdown mode is active or not
        User is logged in or not
     -->
<?php
        if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
            redirect('rooms.php');
        } else if(isset($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
            $login = true;
        } else {
            redirect('rooms.php');
        }

        //filter and get room and user data
    
        $data = filtration($_GET);
        $room_res = select("SELECT * FROM `roomtype` WHERE `RTID` = ?", [$data['id']], 'i');

        if(mysqli_num_rows($room_res) ==0){
            redirect('rooms.php');
        }
        $room_data = mysqli_fetch_assoc($room_res);
       
        $customer_res =select("SELECT * FROM `customer` WHERE  `CustomerID` =? LIMIT 1",[$_SESSION['uId']],'i');
        $customer_data = mysqli_fetch_assoc($customer_res);
        

        if(isset($_SESSION['room']) && isset($_SESSION['booking'])) {
            
            $roomData = $_SESSION['room'];
            $bookingData = $_SESSION['booking'];

        }else{
        redirect('rooms.php');
        }

        $_SESSION['customer'] =[
            "id" => $_SESSION['uId'],
            "name" => $customer_data['CustomerFullName'],
            "ph" => $customer_data['CustomerPhoneNo'],
            "email" => $customer_data['CustomerEmail'],
            "street" => $customer_data['Street'],
            "city" => $customer_data['City'],
            "country" => $customer_data['Country'],
            "postalcode" => $customer_data['PostalCode'],
        ]
    ?>
    
<!-- Main section start -->
<main class="c_main">
    <!-- progress start -->
        <div class="progress-wrapper ">
            <div class="progress_container">
                <ul class="progressbar">
                    <li class="active">Select Rooms</li>
                    <li class="active">Special Request</li>
                    <li class="active">Confirm Reservation</li>
                </ul>
            </div>
        </div>
        <!-- progress end -->
        <br>
    <h2 class="main-title text-center text-uppercase mt-xs-5">CONFIRM RESERVATION</h2>
    <div class="h-line s-line"></div>
    <div class="container-fluid confirm">
        <div class="row d-md-flex align-items-md-center ">
            <div class="col-12 col-md-12 confirm_img grow">
                <?php
                     $room_thumb = RT_IMG_PATH . "thumbnail.jpg";
                     $thumb_q = mysqli_query($con,"SELECT * FROM `rt_images` WHERE `RTID` = '$room_data[RTID]' AND `Active` = '1'");
                     
                     if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = RT_IMG_PATH . $thumb_res['RTImages'];
                    }

                echo <<<data
                        
                            <!-- Room image -->
                            <img src="$room_thumb" alt="room" class="card-img image-fluid rounded mb-3">
                            
                        
                    data;
                ?>
            </div>
            <div class="col-12 col-md-6">
               
                <div class="room-details-container container">
                    <form method="POST" id="confirm_booking_form" actions="pay_now.php">
                        <div class="row">
                            <span class="r-title col-6">Room Type: </span>
                            <p class="r-details col-6">
                                <?php echo $room_data["RTName"] ?>
                            </p>
                            <span class="r-title col-6">Check-in Date: </span>
                            <p class="r-details col-6">
                                <?php echo $bookingData["check_in"]; ?>
                            </p>

                            <span class="r-title col-6">Check-out Date: </span>
                            <p class="r-details col-6">
                                <?php echo $bookingData["check_out"]; ?>
                            </p>
                            <span class="r-title col-6">Number of Guests: </span>
                            <p class="r-details col-6">
                                <?php echo $bookingData["adult"]; ?> Adult(s) , <?php echo $bookingData["children"]; ?> children
                            </p>
                            <span class="r-title col-6">Special Requests: </span>
                            <p class="r-details col-6">
                                <?php echo $bookingData["special_request"]; ?>
                            </p>
                            <div class="col-12">
                                <hr class="divider">
                            </div>
                            <span class="r-title col-6">Total-Amount <span class="total">(Price Per Night * Number of Stays)</span>: </span>
                            <p class="r-details col-6">
                               $ <?php echo $bookingData["totalAmount"]; ?>
                            </p>
                            <span class="r-title col-6 mt-1">Extra Bed: </span>
                            <p class="r-details col-6">
                               $ <?php echo $bookingData["extraBedCost"]; ?>
                            </p>
                            <span class="r-title col-6 mt-1">Tax and Service Charges: </span>
                            <p class="r-details col-6">
                               $ <?php echo $bookingData["tax&Servicecharges"]; ?>
                            </p>
                            <div class="col-12">
                                <hr class="divider">
                            </div>
                            <span class="r-title col-6">Grand Total: </span>
                            <p class="r-details col-6">
                                $ <?php echo $bookingData["GrandTotal"]; ?>
                            </p>
                            <div class="col-12">
                                <!-- <button type="submit" class="btn custom-btn w-100 mb-2" id="paynow" name="pay_now" >Pay Now</button> -->
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>

                        

                    </form>
                    

                </div>
            </div>
            <div class="col-12 col-md-6  mt-4 fade-in">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h6 class="mb-3">Guest Information</h6>
                        <div class="customer-info-container container">
                            <div class="row">
                                <span class="customer-title col-6">Full Name :</span>
                                <p class="customer-info col-6" id="name"><?php echo  $_SESSION['customer']['name'] ?></p>
                                <span class="customer-title col-6">Email :</span>
                                <p class="customer-info col-6" id="email"><?php echo $_SESSION['customer']['email'] ?></p>
                                <span class="customer-title col-6" >Phone No:</span>
                                <p class="customer-info col-6" id="ph"><?php echo $_SESSION['customer']['ph'] ?></p>
                                <span class="customer-title col-6" >Street:</span>
                                <p class="customer-info col-6" id="street"><?php echo $_SESSION['customer']['street'] ?></p>
                                <span class="customer-title col-6">City:</span>
                                <p class="customer-info col-6" id="city"><?php echo $_SESSION['customer']['city'] ?></p>
                                <span class="customer-title col-6">Country:</span>
                                <p class="customer-info col-6" id="country"><?php echo $_SESSION['customer']['country'] ?></p>
                                <span class="customer-title col-6">Postal Code:</span>
                                <p class="customer-info col-6" id="country"><?php echo $_SESSION['customer']['postalcode'] ?></p>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="accordion cancel_accordian col-12 con_cancel " id="cancel_accordian">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cancel" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Cancellation Policy
                    </button>
                    </h2>
                    <div id="cancel" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <ol>
                            <li>Kindly cancel the reservation in advance of two days prior the scheduled date.</li>
                            <li>The Cancellation fee is 20%.</li>
                            <li><strong>Refund : </strong> We will refund 80% of your payment.</li>
                        </ol>
                        

                        
                    </div>
                    </div>
                </div>
                
            </div>
            
            
        </div>
    </div>
    
    
</main>

<!-- Main section end -->
<?php require('./chatbot.php');?>    
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>




   

<!-- footer -->
<?php require('files/footer.php');?>
<!-- Paypal -->

<script src="https://www.paypal.com/sdk/js?client-id=AZpQIP7C1REXbtHIZIuxxzt9-B3JBsJfKmWG0kBx6LITUdkG6EhW7HkuKRhkALEXbWQlpH66GW1dAAkY&components=buttons"></script>





<script>
    
    function pay_now(transactionNo, transactionStatus, transactionDate){
        let data = new FormData();
        data.append('pay_now', "");
        data.append('transactionNo', transactionNo);
        data.append('transactionStatus', transactionStatus);
        data.append('transactionDate', transactionDate);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/pay_now.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Success message
                    console.log("Data sent successfully!");
                     alert("success","Thank You for Your Reservation, <?php echo $_SESSION['customer']['name'] ?>");

                    setTimeout(function() {
                        window.location.href = "reservation.php";
                    },2000); 

                } else {
                    // Error message
                    console.error("Error occurred while sending data!");
                }
            } 
        }
        
        xhr.send(data);
    }
 
    // Create PayPal buttons
  
    window.paypal.Buttons({
        style: {
    layout: 'vertical',
    color:  'silver',
    shape:  'pill',
    label:  'paypal',
    
  },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and currency
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $bookingData["GrandTotal"] ?>' 
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Get the current date and time
            let transactionDate = new Date().toISOString();

            // This function captures the funds from the transaction
            return actions.order.capture().then(function(details) {
                let transactionNo = details.id;
                let transactionStatus = details.status;

                // Call the function to send transaction data to server
                pay_now(transactionNo, transactionStatus, transactionDate);
                
                // Show success message to the user
                alert("Thank You for Your Reservation, <?php echo $_SESSION['customer']['name'] ?>");
            });
        }
    }).render('#paypal-button-container');


     


    // document.addEventListener("DOMContentLoaded", function () {
    // // showAlertMessage()
    
    // }})
</script>








</body>
</html>