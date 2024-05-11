<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 

date_default_timezone_set("Asia/Yangon"); 

if (isset($_POST['check_availability'])) {
    $frm_data = filtration($_POST);

    $status = "";
    $result = "";
    $extraBedCost = "";
    

    //check in and out validation
    
    $today_date = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($frm_data['check_in']);
    $checkout_date = new DateTime($frm_data['check_out']);

    if ($checkin_date == $checkout_date) {
        $status = 'check_in_out_equal';
        $result = json_encode(["status" => $status]);
    }else if($checkout_date < $checkin_date){
        $status = 'check_out_earlier';
        $result = json_encode(["status" => $status]);
    } else if ($checkin_date < $today_date) {
        $status = 'check_in_earlier';
        $result = json_encode(["status" => $status]);
    }

    // check booking availability if status is black else return the error

    if ($status !='') {
        echo $result;
    }else{
        session_start();
        $_SESSION['room'];
        
         // Store booking details in session
        $_SESSION['booking'] = [
            "check_in" => $frm_data['check_in'],
            "check_out" => $frm_data['check_out'],
            "arrival" => $frm_data['arrival'],
            "special_request" => isset($frm_data['special_request']) ? $frm_data['special_request'] : "None",
            "adult" => $frm_data['adult'],
            "children" => $frm_data['children'],
            "totalAmount" => null,
            "tax&Servicecharges" => null,
            "extraBedCost" => null,
            "GrandTotal" => null,
        ];

        // run query to check room is available or not
        $tb_q = "SELECT 
    COUNT(reservation.ReservationID) AS `total_reservations`
    FROM 
        reservation
    INNER JOIN 
        checkIn ci ON reservation.ReservationID = ci.ReservationID
    INNER JOIN 
        checkOut co ON reservation.ReservationID = co.ReservationID
    INNER JOIN 
        reservationdetails rd ON reservation.ReservationID = rd.ReservationID
    INNER JOIN 
        roomType ro ON ro.RTID = rd.RTID
    WHERE 
        reservation.`ReservationStatus` = ?
        AND ro.`RTID` = ?
        AND co.`CheckOutDate` > ?
        AND ci.`CheckInDate` < ?
";
        $t_values = ['ASSIGNED',$_SESSION['room']['id'],$frm_data['check_in'],$frm_data['check_out']];

        $tb_fetch = mysqli_fetch_assoc(select($tb_q, $t_values, 'siss'));

        
        $rq_result = select("SELECT `RTQuantity` FROM `roomtype` WHERE `RTID`=?", [$_SESSION['room']['id']], 'i');


        $rq_fetch = mysqli_fetch_assoc($rq_result);

        if (($rq_fetch['RTQuantity'] - $tb_fetch['total_reservations'])==0) {
            $status = 'unavailable';
            $result = json_encode(['status'=>$status]);
            echo $result;
            exit;
        }

        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $totalAmount=  $_SESSION['room']['price'] * $count_days;
        $_SESSION['room']['available'] = true;
        $_SESSION['booking']['totalAmount'] = $totalAmount;
        
        $taxServiceCharges = $totalAmount * (0.1);//10% tax and service charges

        
        if (strpos($_SESSION['booking']['special_request'], 'Extra bed requested')!== false) {
           
            $extraBedCost = 20; 
        } else {
            
            $extraBedCost = 0;
        }

        $GrandTotal = $totalAmount + $taxServiceCharges + $extraBedCost;

        $_SESSION['booking']['tax&Servicecharges'] = $taxServiceCharges;
        $_SESSION['booking']['extraBedCost'] = $extraBedCost;
        $_SESSION['booking']['GrandTotal'] = $GrandTotal;



        $result = json_encode(["status" => 'available', "days" => $count_days, "totalAmount"=> $totalAmount, "arrival" => $frm_data['arrival'],"specialrequest" =>$_SESSION['booking']['special_request'] ,"adult" => $_SESSION['booking']['adult'],"children" => $_SESSION['booking']['children']]);
        echo $result;
    }
}
?>