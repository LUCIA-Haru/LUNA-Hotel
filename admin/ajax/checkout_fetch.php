
<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();
if (isset($_POST['get_reservations'])) {
    $frm_data = filtration($_POST);
    $query = "SELECT DISTINCT r.*, ci.*, co.*, c.*, ro.*, p.*
          FROM reservation r 
          INNER JOIN checkIn ci ON r.ReservationID = ci.ReservationID 
          INNER JOIN checkOut co ON r.ReservationID = co.ReservationID 
          INNER JOIN customer c ON ci.CustomerID = c.CustomerID 
          INNER JOIN reservationdetails rd ON r.ReservationID = rd.ReservationID 
          INNER JOIN roomType ro ON ro.RTID = rd.RTID
          INNER JOIN room rm ON rm.RTID = ro.RTID
          INNER JOIN payment p ON co.CheckOutID = p.CheckOutID
          WHERE (r.ReservationNo LIKE ? 
                 OR c.CustomerPhoneNo LIKE ? 
                 OR c.CustomerEmail LIKE ? 
                 OR c.CustomerFullName LIKE ?
                 OR ro.RTName LIKE ?) 
                 AND r.ReservationStatus = 'ASSIGNED'
          ORDER BY r.ReservationID ASC;";

        // Adjust search term to include wildcards
     $searchTerm = '%' . $frm_data['search'] . '%';
    $res = select($query, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm], 'sssss');
    $i = 1;
    $table_data = "";
    if (mysqli_num_rows($res)==0) {
        echo "<b>No Data Found</b>";
        exit;
    }
    
    while ($data = mysqli_fetch_assoc($res)) {
        $paymentdate = date("d-m-Y H:i:s", strtotime($data['PaymentDateTime']));
        $checkin_date = date("d-m-Y", strtotime($data['CheckInDate']));
        $checkout_date = date("d-m-Y", strtotime($data['CheckOutDate']));
        $TransactionDate = date("d-m-Y", strtotime($data['TransactionDate']));
        $ReservationDate = date("d-m-Y", strtotime($data['ReservationDate']));
        
        $table_data .= "
            <tr>
                <td>$i</td>
                <td>
                    
                    <b>Name :</b> $data[CustomerFullName]
                    <br>
                    <b>PhoneNo :</b> $data[CustomerPhoneNo]
                    <br>
                    <b>Email :</b> $data[CustomerEmail]
                <br>
                </td>
                <td>
                
                    <b>Room Type :</b> $data[RTName]
                    <br>
                    <b>Price Per Night :</b>$ $data[PricePerNight]
                    <br>
                    <b>Area :</b> $data[Area]
                    <br>
                    
                </td>
                <td>
                    <span class='badge bg-light text-black'>
                        ReservationNo : $data[ReservationNo]
                    </span>
                    <br>
                    <b>Check-In Date :</b> $checkin_date
                    <br>
                    
                    <b>Check-Out Date :</b> $checkout_date
                    <br>
                    <b>Estimated Arrival Time :</b> $data[ArrivalTime];
                    <br>
                    
                    <b>Special Request :</b> $data[SpecialRequest]
                    <br>
                    <b>Reservation Date :</b> $ReservationDate 
                    <br>
                    <b>Check In
                    Status :</b> <span class='text-primary'>$data[CheckInStatus]</span> 
                    <br>
                    <b>Reservation 
                    Status :</b> <span class='text-primary'>$data[ReservationStatus]</span> 
                    <br>
                </td>
                <td>
                    <span class='badge bg-light text-black'>
                        TransactionNo : $data[TransactionNo]
                    </span>
                    <br>
                    <b>Transaction Date :</b> $TransactionDate
                    <br>
                    <b>Transaction Status :</b> <span class='text-success'>$data[TransactionStatus]</span> 
                    <br>
                    <b>Payment Date & Time :</b>$paymentdate;
                    <br>
                    <b>Total Amount :</b>$ $data[TotalAmount]
                    <br>
                    <b>Tax & Service Charges :</b>$ $data[Tax_Service_Charges]
                    <br>
                    <b>Grand Total :</b>$ $data[GrandTotal]
                    <br>
                    
                </td>
                <td>
                $data[CheckInTime]
                    
                </td>
                <td>
                    <!-- Button trigger modal -->
                    
                    <button type='button' onclick='checkout_room({$data['ReservationID']})' class='btn btn-outline-danger btn-sm rounded d-flex mt-2'>
                    <i class='bi bi-cart-x-fill'></i> Check Out
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }
    echo $table_data;
}


if (isset($_POST['checkout_room'])) {
    $frm_data = filtration($_POST);
    $query = "UPDATE `checkout` co 
            INNER JOIN `reservation` r ON co.ReservationID = r.ReservationID
            SET co.`CheckOutTime` = CURRENT_TIMESTAMP(),
                co.`CheckOutDate` =  DATE(NOW()),
                co.`CheckOutStatus` = ?,
                r.`ReservationStatus` = ?
            WHERE co.`ReservationID` = ?";
    $values = ['Confirmed', 'CHECKED OUT', $frm_data['ReservationID']];
    $result = update($query, $values, 'ssi');

    if ($result) {
       $u_query = "UPDATE `room` rm
        INNER JOIN roomType ro ON ro.RTID = rm.RTID
        INNER JOIN reservationdetails rd ON ro.RTID = rd.RTID
        SET rm.RoomStatus = ?
        WHERE rd.ReservationID = ?";
        $u_values = [1, $frm_data['ReservationID']];
        $result2 = update($u_query, $u_values, 'ii');
    }
    echo $result2;

    
}
?>
