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
<?php require('files/header.php');
if(!isset($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
    redirect('index.php');
} 
?>

    
<!-- Main section start -->
<main id="c-main">
    <h2 class="main-title text-center text-uppercase m_top gs_reveal ">RESERVATION</h2>
    <div class="h-line s-line"></div>
    <div class="container">
        <div class="row">
            <!-- Reservation -->
            <?php
                $query = "SELECT r.*, ci.*, co.*, c.*, ro.*, p.*
                    FROM reservation r 
                    INNER JOIN checkIn ci ON r.ReservationID = ci.ReservationID 
                    INNER JOIN checkOut co ON r.ReservationID = co.ReservationID 
                    INNER JOIN customer c ON ci.CustomerID = c.CustomerID 
                    INNER JOIN reservationdetails rd ON r.ReservationID = rd.ReservationID 
                    INNER JOIN roomType ro ON ro.RTID = rd.RTID
                    INNER JOIN payment p ON co.CheckOutID = p.CheckOutID
                    WHERE (
                        (r.ReservationStatus = 'CONFIRMED' OR r.ReservationStatus = 'ASSIGNED' OR r.ReservationStatus = 'CHECKED OUT') 
                    OR (r.ReservationStatus = 'CANCELLED')
                    OR (p.TransactionStatus = 'COMPLETED')
                    OR (co.CheckOutStatus = 'CONFIRMED'))     
                    AND (c.CustomerID = ?)                 
                    ORDER BY r.ReservationID DESC";

                $result = select($query, [$_SESSION['uId']], 'i');

                while($data = mysqli_fetch_assoc($result)){
                    $paymentdate = date("d-m-Y | H:i:s", strtotime($data['PaymentDateTime']));
                    $checkin_date = date("d-m-Y", strtotime($data['CheckInDate']));
                    $checkout_date = date("d-m-Y", strtotime($data['CheckOutDate']));
                    $TransactionDate = date("d-m-Y", strtotime($data['TransactionDate']));
                    $ReservationDate = date("d-m-Y", strtotime($data['ReservationDate']));

                    $status_bg = "";
                    $btn = "";

                    if ($data['ReservationStatus'] == 'ASSIGNED') {
                        $status_bg = "bg-success";

                        if ($data['CheckInStatus']=='Checked In') {
                            $btn = "
                            <a href='generate_pdf.php?gen_pdf&id=$data[ReservationID]'  class='btn btn-outline-dark btn-sm rounded  mt-2'>
                                Download PDF</a>
                            
                                ";

                            if ($data['Review_Rate_status']==0) {
                                $btn .= "<button type='button' onclick='review_room($data[ReservationID],$data[RTID])' class='btn btn-outline-warning btn-sm rounded  mt-2 ms-2' data-bs-toggle='modal' data-bs-target='#rateModal'>Review & Rate</button>
                                ";
                            }
                        }else{
                            $btn = " <button onclick='cancel_reservations($data[ReservationID])' type='button' class='btn btn-outline-danger btn-sm rounded mt-2'>Cancel</button>";
                        }
                    }else if($data['ReservationStatus'] == 'CONFIRMED'){
                        $status_bg = "bg-info";
                        $btn = "
                            <a href='generate_pdf.php?gen_pdf&id=$data[ReservationID]'  class='btn btn-outline-dark btn-sm rounded mt-2 me-2'>
                            Download PDF</a>

                            <button onclick='cancel_reservations($data[ReservationID])' type='button' class='btn btn-outline-danger btn-sm rounded mt-2'>Cancel</button>
                            ";
                            if ($data['Review_Rate_status']==0) {
                                $btn .= "<button type='button' onclick='review_room($data[ReservationID],$data[RTID])' class='btn btn-outline-warning btn-sm rounded  mt-2 ms-2' data-bs-toggle='modal' data-bs-target='#rateModal'>Review & Rate</button>
                                ";
                            }
                        
                    }else if($data['ReservationStatus'] == 'CANCELLED'){
                        $status_bg = "bg-danger";

                        if ($data['RefundStatus']=='REFUNDED') {
                            $btn = "<a href='generate_pdf.php?gen_pdf&id={$data['ReservationID']}' class='btn btn-outline-dark btn-sm rounded mt-2'>
                            Download PDF</a>";

                        }else{
                            $btn = " <span class='badge bg-primary'>Refund In Process!</span>";
                        }
                    }else{
                        $status_bg = "bg-warning";
                        $btn = "<a href='generate_pdf.php?gen_pdf&id={$data['ReservationID']}' class='btn btn-outline-dark btn-sm rounded mt-2'>
                        Download PDF</a>
                        
                        ";
                        if ($data['Review_Rate_status']==0) {
                                $btn .= "<button type='button' onclick='review_room($data[ReservationID],$data[RTID])' class='btn btn-outline-warning btn-sm rounded  mt-2 ms-2' data-bs-toggle='modal' data-bs-target='#rateModal'>Review & Rate</button>
                                ";
                            }

                    }

                    echo <<<reservations
                        <div class='col-10 col-md-4 px-4 mb-4 m-auto'>
                            <div class='container-bg p-3 rounded shadow-sm'>
                                <h5 class='rt-name fw-bold'>$data[RTName]</h5>
                                <p class='rt-price '>$ $data[PricePerNight] Per Night</p>
                                <p>
                                    <b>Check In:</b> $checkin_date  <br>
                                    <b>Check Out:</b> $checkout_date
                                </p>
                                <p>
                                    <b>Reservation No:</b> $data[ReservationNo]  <br>
                                    <b>Grand Total:</b> $  $data[GrandTotal] <br>
                                    <b>Reservation Date:</b>  $ReservationDate
                                </p>
                                <p>
                                    <span class='badge $status_bg shadow'>$data[ReservationStatus]</span>
                                </p>
                                $btn
                            </div>
                        </div>
                    reservations;
                }
                ?>
    
    <!-- Reservation -->
        </div>
    </div>
    <!-- rate modal -->
     <div class="modal fade z-model" id="rateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-bg">
                    <form id="review-Form" method="POST">
                        
                        <div class="modal-header  border-0 shadow-none">
                            
                            <h3 class="modal-title col-10 d-flex align-items-center justify-content-center" ><i class="bi bi-chat-square-heart-fill"></i>Review & Rate</h3>
                            <button type="reset" class="btn-close col-2" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            
                            <div class="container-fluid ">
                                <div class="row mb-0">
                                    <div class="col-12 ps-0 mb-3">
                                        <label class="form-label">Rate</label>
                                        <select name="rate" class="form-select shadow-none text-uppercase" required>
                                            <option value="" selected disabled></option>
                                            <option value="5">Excellent</option>
                                            <option value="4">Good</option>
                                            <option value="3">Ok</option>
                                            <option value="2">Poor</option>
                                            <option value="1">Bad</option>
                                        </select>
                                    </div>
                                
                                    <div class="col-12 ps-0 ">
                                        <label class="form-label">Review</label><br>
                                        <textarea class="text_msg" name="review"  rows="3" placeholder="Write your review here..."></textarea>
                                    </div>
                                    <input type="hidden" name="reservation___id">
                                    <input type="hidden" name="room___id">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-end border-0 shadow-none">
                            
                            <button type="submit" class="btn btn-color2 btn-md">submit</button>
                        </div>
                    

                    </form>
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


<?php
if(isset($_GET['cancel_status'])) {
    alert('success', 'Reservation Cancelled');
}else if(isset($_GET['review_status'])) {
    alert('success', 'Thank you for the ratings and reviews.');
}
?>


   

<!-- footer -->
<?php require('files/footer.php');?>



<script>
    function cancel_reservations(id){
        if (confirm('Are you sure to cancel this reservation?')) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/cancel_reservation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if(this.responseText==1){
                    window.location.href="reservation.php?cancel_status=true";
                }else{
                    alert('error', 'Cancellation Failed!')
                }
            };

            xhr.send("cancel_reservations&id=" + id);
        }
    }


    // review

    let review_form =document.getElementById('review-Form');
    function review_room(reservation___id,room___id){
        review_form.elements['reservation___id'].value = reservation___id;
        review_form.elements['room___id'].value = room___id;
    }

    review_form.addEventListener('submit',function (e) {
        e.preventDefault();

       send_review();

    })
    function send_review(){
         let data = new FormData();
        data.append("review_form", "");
        data.append("rating", review_form.elements['rate'].value);
        data.append("review", review_form.elements['review'].value);
        data.append("reservation___id",review_form.elements['reservation___id'].value);
        data.append("room___id", review_form.elements['room___id'].value);
        
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/review_fetch.php", true);
            

            xhr.onload = function () {
                  var myModal = document.getElementById("rateModal");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText.trim() == 0) {
                    alert("error", "Rate & Review Failed!");
                } 
                else{
                    window.location.href='reservation.php?review_status=true';
                    review_form.reset();
                };
            }
            xhr.send(data);
    }
</script>








</body>
</html>