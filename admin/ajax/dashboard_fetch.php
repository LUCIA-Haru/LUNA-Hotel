<?php
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

if (isset($_POST['reservation_analytic'])) {
    $frm_data = filtration($_POST);

    $condition = "";
    if ($frm_data['period']==1) {
        $condition = "WHERE PaymentDateTime BETWEEN  NOW() - INTERVAL 30 DAY AND NOW() ";
    }
    else if ($frm_data['period']==2) {
        $condition = "WHERE PaymentDateTime BETWEEN  NOW() - INTERVAL 90 DAY AND NOW() ";
    }
    else if ($frm_data['period']==3) {
        $condition = "WHERE PaymentDateTime BETWEEN  NOW() - INTERVAL 1 YEAR AND NOW() ";
    }

    $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT

    COUNT(r.ReservationID) AS total_reservations,
    COALESCE(SUM(p.GrandTotal),0) AS all_total,

    COUNT(CASE WHEN r.ReservationStatus = 'CANCELLED' AND p.RefundStatus ='REFUNDED' THEN 1 END) AS Cancelled_Reservations,
    COALESCE(SUM(CASE WHEN r.ReservationStatus = 'CANCELLED' AND p.RefundStatus ='REFUNDED' THEN p.RefundAmount END),0) AS Refund_Amount,

    COUNT(CASE WHEN r.ReservationStatus = 'ASSIGNED' AND ci.CheckInStatus = 'Checked In' THEN 1 END) AS Active_Reservations,
    COALESCE(SUM(CASE WHEN r.ReservationStatus = 'ASSIGNED' AND ci.CheckInStatus = 'Checked In' THEN p.GrandTotal END),0) AS active_amount,

    COUNT(CASE WHEN r.ReservationStatus = 'CONFIRMED' AND ci.CheckInStatus = 'Pending' THEN 1 END) AS Confirm_Reservations,
    COALESCE(SUM(CASE WHEN r.ReservationStatus = 'CONFIRMED' AND ci.CheckInStatus = 'Pending' THEN p.GrandTotal END),0) AS confirm_amount,

    COUNT(CASE WHEN r.ReservationStatus = 'CHECKED OUT' AND co.CheckOutStatus = 'CONFIRMED' THEN 1 END) AS Checkout_Reservations,
    COALESCE(SUM(CASE WHEN r.ReservationStatus = 'CHECKED OUT' AND co.CheckOutStatus = 'CONFIRMED' THEN p.GrandTotal END),0) AS Checkout_amount

    FROM 
    reservation r
    INNER JOIN checkIn ci ON r.ReservationID = ci.ReservationID 
    INNER JOIN checkOut co ON r.ReservationID = co.ReservationID 
    INNER JOIN reservationdetails rd ON r.ReservationID = rd.ReservationID 
    INNER JOIN roomType ro ON ro.RTID = rd.RTID
    INNER JOIN payment p ON co.CheckOutID = p.CheckOutID $condition;

    "));
    $output = json_encode($result);

    echo $output;
}
if (isset($_POST['customer_analytic'])) {
    $frm_data = filtration($_POST);

    $condition = "";
    if ($frm_data['period'] == 1) {
        $condition = "WHERE DateTime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
    } else if ($frm_data['period'] == 2) {
        $condition = "WHERE DateTime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
    } else if ($frm_data['period'] == 3) {
        $condition = "WHERE DateTime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
    }

    $total_newreg = mysqli_fetch_assoc(mysqli_query($con, "SELECT 
        COUNT(CustomerID) AS `count`
        FROM `customer` $condition;"
    ));

    $output = json_encode($total_newreg);

    echo $output;
}

?>