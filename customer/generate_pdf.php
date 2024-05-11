<?php


require('./../admin/files/db_config.php'); 
require('./../admin/files/essentials.php'); 
require('./../admin/files/mpdf/vendor/autoload.php'); 

date_default_timezone_set("Asia/Yangon");
session_start();

if (!isset ($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
    redirect('index.php');
}

if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filtration($_GET);

    $query = "SELECT 
        r.*, ci.*, co.*, c.*, ro.*, p.*
        FROM 
            reservation r 
        INNER JOIN 
            checkIn ci ON r.ReservationID = ci.ReservationID 
        INNER JOIN 
            checkOut co ON r.ReservationID = co.ReservationID 
        INNER JOIN 
            customer c ON ci.CustomerID = c.CustomerID 
        INNER JOIN 
            reservationdetails rd ON r.ReservationID = rd.ReservationID 
        INNER JOIN 
            roomType ro ON ro.RTID = rd.RTID
        INNER JOIN 
            payment p ON co.CheckOutID = p.CheckOutID
        WHERE 
            (
                (r.ReservationStatus = 'CONFIRMED || ASSIGNED' AND ci.CheckInStatus = 'Checked In') 
                OR (r.ReservationStatus = 'CANCELLED' AND p.RefundStatus = 'REFUNDED')
                OR (p.TransactionStatus = 'COMPLETED')
                OR (co.CheckOutStatus = 'Checked Out')     
            ) 
            AND r.ReservationID = $frm_data[id];
        ";

         $res = mysqli_query($con,$query);

        $total_rows = mysqli_num_rows($res);


        if ($total_rows==0) {
            header('location : index.php');
            exit;
        }

    $data = mysqli_fetch_assoc($res);
    $paymentdate = date("d-m-Y | H:i:s", strtotime($data['PaymentDateTime']));
    $checkin_date = date("d-m-Y", strtotime($data['CheckInDate']));
    $checkout_date = date("d-m-Y", strtotime($data['CheckOutDate']));
    $TransactionDate = date("d-m-Y", strtotime($data['TransactionDate']));
    $ReservationDate = date("d-m-Y", strtotime($data['ReservationDate']));

$table_data = "
    <h2 >BOOKING RECEIPT</h2>
    <div >
        <table style='width:700px;' >
            <tr>
                <td colspan='2'>Reservation Details</td>
            </tr>
            <tr>
                <td>ReservationNo</td>
                <td>{$data['ReservationNo']}</td>
            </tr>
            <tr>
                <td>Reservation Date</td>
                <td>{$ReservationDate}</td>
            </tr>
            <tr>
                <td>Reservation Status</td>
                <td>{$data['ReservationStatus']}</td>
            </tr>
            <tr>
                <td>CheckIn Date</td>
                <td>{$checkin_date}</td>
            </tr>
            <tr>
                <td>CheckOut Date</td>
                <td>{$checkout_date}</td>
            </tr>
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>
            <tr>
                <td colspan='2'>Customer Details</td>
            </tr>
            <tr>
                <td>Full-Name</td>
                <td>{$data['CustomerFullName']}</td>
            </tr>
            <tr>
                <td>Phone No</td>
                <td>{$data['CustomerPhoneNo']}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{$data['CustomerEmail']}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{$data['Street']}, {$data['City']}, {$data['Country']}</td>
            </tr>
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>
            <tr>
                <td colspan='2'>Room Type Details</td>
            </tr>
            <tr>
                <td>Room Type</td>
                <td>{$data['RTName']}</td>
            </tr>
            <tr>
                <td>Price Per Night</td>
                <td>$ {$data['PricePerNight']}</td>
            </tr>
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>
            <tr>
                <td colspan='2' >Payment Details</td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td>$ {$data['TotalAmount']}</td>
            </tr>
            <tr>
                <td>Tax & Service Charges</td>
                <td>$ {$data['Tax_Service_Charges']}</td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td>$ {$data['GrandTotal']}</td>
            </tr>
            <tr>
                <td>Transaction Date</td>
                <td>{$TransactionDate}</td>
            </tr>
            <tr>
                <td>Payment Date Time</td>
                <td>{$paymentdate}</td>
            </tr>";

if ($data['ReservationStatus'] == 'CANCELLED') {
    $refund = ($data['RefundAmount']) ? " {$data['RefundDateTime']}" : "Not Yet Refunded";
    $table_data .= "
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>
            <tr>
                <td colspan='2'>Refund Details</td>
            </tr>
            <tr>
                <td>Refund Amount</td>
                <td>$ {$data['RefundAmount']}</td>
            </tr>
            <tr>
                <td>Refund Date Time</td>
                <td>$ {$refund}</td>
            </tr>
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>";
} else {
    $table_data .= "
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>
            <tr>
                <td colspan='2'>Room Details</td>
            </tr>
            <tr>
                <td>Assigned Room No</td>
                <td>{$data['Room_No']}</td>
            </tr>
            <tr>
                <td>Special Request</td>
                <td>{$data['SpecialRequest']}</td>
            </tr>
            <tr>
                <td>Amount Paid</td>
                <td>$ {$data['GrandTotal']}</td>
            </tr>
            <tr>
                <td colspan='2'><hr style='height:3px;'></td>
            </tr>";
}

$table_data .= "</table></div>";

// mpdf
require_once './../admin/files/mpdf/vendor/autoload.php'; 
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$mpdf->WriteHTML($table_data);

// Output a PDF file directly to the browser
$mpdf->Output($data['ReservationNo'].'.pdf', 'D');


}else{
    header('location : index.php');
}

?>