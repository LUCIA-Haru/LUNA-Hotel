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
        
        $_SESSION['room'] = [
            "id" => $room_data['RTID'],
            "name" => $room_data['RTName'],
            "price" => $room_data['PricePerNight'],
            
            "available"=> false,
            
        ];
        if(isset($_SESSION['search_data'])) {
            $search_data= $_SESSION['search_data'];
            // Use the booking data as needed
            $checkin = $search_data['checkin'];
            $checkout = $search_data['checkout'];
            $adult = $search_data['adult'];
            $children = $search_data['children'];
        }
        $customer_res =select("SELECT * FROM `customer` WHERE  `CustomerID` =? LIMIT 1",[$_SESSION['uId']],'i');
    $customer_data = mysqli_fetch_assoc($customer_res);
        
 
    
    ?>
    
<!-- Main section start -->
<main class="c_main">
    <!-- progress start -->
        <div class="progress-wrapper fade-in">
            <div class="progress_container">
                <ul class="progressbar">
                    <li class="active">Select Rooms</li>
                    <li class="active">Special Request</li>
                    <li>Confirm Reservation</li>
                </ul>
            </div>
        </div>
        <!-- progress end -->
    <h2 class="main-title text-center text-uppercase gs_reveal ">RESERVATION DETAILS</h2>
    <div class="h-line s-line"></div>
    <div class="container-fluid confirm">
        <div class="row d-md-flex align-content-md-center justify-content-md-center">
            <div class="col-12 col-md-6">
                <?php
                     $room_thumb = RT_IMG_PATH . "thumbnail.jpg";
                     $thumb_q = mysqli_query($con,"SELECT * FROM `rt_images` WHERE `RTID` = '$room_data[RTID]' AND `Active` = '1'");
                     
                     if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = RT_IMG_PATH . $thumb_res['RTImages'];
                    }
                    $rating_q = "SELECT AVG(Rating) AS `avg_rating` FROM `reviews` WHERE `RTID` = '$room_data[RTID]' ORDER BY `RTID` DESC LIMIT 20";

                        $rating_res = mysqli_query($con, $rating_q);
                        $rating_fetch = mysqli_fetch_assoc($rating_res);

                        $rating_data = "";

                        if($rating_fetch['avg_rating'] != NULL){
                            $rating_data = "<div class='rating mb-4'>
                            
                            <span class='badge rounded-pill bg-white text-dark text-wrap'>
                            ";
                            for ($i=0; $i < $rating_fetch['avg_rating'] ; $i++) {
                            $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
                            }
                            $rating_data .= "</span>
                            </div>";
                        }
                echo <<<data
                        <div class="card p-3 shadow-sm rounded shrink">
                            <!-- Room image -->
                            <img src="$room_thumb" alt="room" class="card-img image-fluid rounded mb-3">
                            <h5 class="text-center">$room_data[RTName]</h5>
                            <h6 class="text-center">$ $room_data[PricePerNight] per night</h6>
                            <div class="m-2 text-center">$rating_data</div>
                            

                            <i class="bi bi-luggage-fill"></i><span class="">Check-In/Check-Out: <span class="times"> 2:00pm /12:00pm</span></span>
                            <br><i class="bi bi-cup-hot-fill"></i><span class="">Breakfast Included</span>
                            <br><i class="bi bi-clock-fill"></i><span class="">24 hr Room Service</span>
                            <br><i class="bi bi-lightning-charge-fill"></i><span class="">24 hr Electricity</span>
                            
                            
                            
                        </div>
                    data;
                ?>
            </div>
            <div class="col-12 col-md-6 mt-3 mt-md-5 gs_reveal gs_reveal_fromRight">
                <form method="POST" id="request_form">
                    <h5 class="mb-3 text-center">SPECIAL REQUESTS</h5>
                    <span class="request-note ">Please let us know if you have any additional requests. You may add them any time by managing your booking online or by contacting us.</span>
                    
                        <div class="request-container mt-2">
                            <p class="request-heading ">
                                ROOM PREFERENCE
                            </p>
                                <div class="first-preference rounded">
                                    <label class="form-label"> Smoking or Non-Smoking Room</label>
                                    <p class="non-smoking-room ">- This is a Non-Smoking Hotel.</p>
                                </div>
                                <div class="h-line "></div>
                                <div class="second-preference">
                                    <label class="form-label">Special Requests</label>
                                    <p class="special-note ">*Special requests are not guaranteed depending on hotel circumstances, and additional charges may apply.</p>
                                    <input type="checkbox" name="extrabed" id="extrabed"> Extra Bed
                                    <br>
                                    <textarea name="request" class="text_msg mt-3" id="request" placeholder="Write your request here..." ></textarea>
                                </div>
                        
                        </div>    
                    
                </form>
            </div>
            <div class="accordion cancel_accordian rt_cancel gs_reveal gs_reveal_fromLeft" id="cancel_accordian">
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
            <div class="col-12 col-md-6  mt-4 reservation_details_container gs_reveal gs_reveal_fromRight">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <form id="booking_form">
                            <h6 class="mb-3">RESERVATION DETAILS</h6>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input name="name" type="text" value="<?php echo $customer_data['CustomerFullName'] ?>"  class="form-control shadow-none "  readonly>
                                </div>
                                <div class="col-sm-6 col-xs-12 mb-3">
                                    <label class="form-label">Phone No:</label>
                                    <input name="phno" value="<?php echo $customer_data['CustomerPhoneNo'] ?>" type="text" class="form-control shadow-none" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <input name="address" value="<?php echo $customer_data['Street']  ?>,   <?php echo $customer_data['City'] ?>, <?php echo $customer_data['Country'] ?>" type="text" class="form-control shadow-none request_address"  readonly>
                                </div>
                                <div class="col-sm-6 col-xs-12 mb-3">
                                    <label class="form-label">Check-In</label>
                                    <input name="checkin-confirm" type="date" placeholder="YYYY-MM-DD" value="<?php echo $checkin  ?>"  class="form-control shadow-none" onchange="check_availability()" required >
                                </div>
                                <div class="col-sm-6 col-xs-12 mb-3">
                                    <label class="form-label">Check-Out</label>
                                    <input name="checkout-confirm" value="<?php echo $checkout  ?>"  type="date" placeholder="YYYY-MM-DD"  class="form-control shadow-none" onchange="check_availability()" required >
                                </div>
                                <div class="col-sm-6 col-xs-12 mb-3">
                                    <label class="form-label check">Adult</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                        <input type="number" class="form-control" id="adultInput" name="adult-confirm" value="<?php echo $adult  ?>" min="0" max="8" onchange="check_availability()">
                                        <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 mb-sm-3">
                                    <label class="form-label check">Children</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                        <input type="number" class="form-control" id="childrenInput" name="children-confirm" value="<?php echo $children  ?>" min="0" max="8" onchange="check_availability()">
                                        <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Arrival Estimated Time</label> <br>
                                    <input type="time" name="arrival" id="arrival" placeholder="Please Enter Estimated Arrival Time..." class="form-control shadow-none" onchange="check_availability()" required>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>

                                    <h6 class="confirm-note" id="book_info">Please Enter The Estimated Arrival Time!</h6>

                                    <button type="submit" class="btn custom-btn w-100" id="nextStepButton" name="next_step" data-status="<?php echo json_encode($login); ?>" data-rt-id="<?php echo $room_data['RTID']; ?>" disabled>Next Step</button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</main>
<?php require('./chatbot.php');?>    
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>





   

<!-- footer -->
<?php require('files/footer.php');?>
<script src="./js/booking.js"></script>
<script>
    function ConfirmBook() {
  document
    .getElementById("nextStepButton")
    .addEventListener("click", function (event) {
      event.preventDefault();

      // Get status and RT_ID from the button attributes
      let status = this.getAttribute("data-status");
      let RT_ID = this.getAttribute("data-rt-id");

      if (status === "true") {
        window.location.href = "confirm_booking.php?id=" + RT_ID;
      } else {
        alert("error", "Please login to make a reservation!");
      }
    });
}
document.addEventListener("DOMContentLoaded", () => {
  ConfirmBook();
});
</script>

</body>
</html>