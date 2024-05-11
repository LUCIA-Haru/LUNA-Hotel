<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

if (isset($_POST['get_reservations'])) {
    $frm_data = filtration($_POST);

    $limit = 1; // limit for pagination
    $page = $frm_data['page'];
    $start = ($page - 1) * $limit;

    //page 1: 0,10 

    $query = "SELECT r.*, ci.*, co.*, c.*, ro.*, p.*
          FROM reservation r 
          INNER JOIN checkIn ci ON r.ReservationID = ci.ReservationID 
          INNER JOIN checkOut co ON r.ReservationID = co.ReservationID 
          INNER JOIN customer c ON ci.CustomerID = c.CustomerID 
          INNER JOIN reservationdetails rd ON r.ReservationID = rd.ReservationID 
          INNER JOIN roomType ro ON ro.RTID = rd.RTID
          INNER JOIN payment p ON co.CheckOutID = p.CheckOutID
          WHERE ((r.ReservationStatus = 'CONFIRMED' AND ci.CheckInStatus = 'Checked In') 
          OR (r.ReservationStatus = 'CANCELLED' AND p.RefundStatus = 'REFUNDED')
          OR (p.TransactionStatus = 'COMPLETED')
          OR (co.CheckOutStatus = 'Checked Out'))     
          AND (r.ReservationNo LIKE ? 
                 OR c.CustomerPhoneNo LIKE ? 
                 OR c.CustomerEmail LIKE ? 
                 OR c.CustomerFullName LIKE ?
                 OR ro.RTName LIKE ?) 
                 
          ORDER BY r.ReservationID DESC";

        // Adjust search term to include wildcards
     $searchTerm = '%' . $frm_data['search'] . '%';

    $res = select($query, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm], 'sssss');

    $limit_query = $query ." LIMIT $start, $limit";
    $limit_res = select($limit_query, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm], 'sssss');

    

    $total_rows = mysqli_num_rows($res);


    if ($total_rows==0) {
        $output = json_encode(['Reservations_data' =>"<b>No Data Found</b>","pagination"=> '']);
        echo $output;
        exit;
    }
    $i = $start+1;
    $table_data = "";

    while ($data = mysqli_fetch_assoc($res)) {
        $paymentdate = date("d-m-Y | H:i:s", strtotime($data['PaymentDateTime']));
        $checkin_date = date("d-m-Y", strtotime($data['CheckInDate']));
        $checkout_date = date("d-m-Y", strtotime($data['CheckOutDate']));
        $TransactionDate = date("d-m-Y", strtotime($data['TransactionDate']));
        $ReservationDate = date("d-m-Y", strtotime($data['ReservationDate']));
        
        if ($data['ReservationStatus']== 'ASSIGNED') {
            $status_bg = 'bg-success';
        }else if ($data['ReservationStatus']== 'CONFIRMED') {
            $status_bg = 'bg-info';
        }else if ($data['ReservationStatus']== 'CANCELLED') {
            $status_bg = 'bg-danger';
        }else{
            $status_bg = 'bg-warning';
        }

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
                   
                    <b>Arrival Time :</b> $data[ArrivalTime];
                    <br>
                    <b>Special Request :</b> $data[SpecialRequest]
                    <br>
                    <b>Reservation Date :</b> $ReservationDate 
                    <br>
                    <b>Reservation Status :</b> <span class='text-primary'>$data[ReservationStatus]</span> 
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
                    <span class='badge $status_bg'>$data[ReservationStatus]</span>
                
                </td>
                <td>
                    
                    
                    <button type='button' onclick='download({$data['ReservationID']})' class='btn btn-outline-info btn-sm rounded d-flex mt-2'>
                    <i class='bi bi-filetype-pdf me-1'></i> Print 
                    
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }

    $pagination = "";
    if ($total_rows > $limit) {
    $total_pages = ceil($total_rows/$limit);

    // First page button
    if($page != 1){
        $pagination .= "<li class='page-item'><button onclick='change_page(1)' class='page-link shadow-none'>First</button></li>";
    } else {
        $pagination .= "<li class='page-item disabled'><button class='page-link shadow-none'>First</button></li>";
    }

    // Previous page button
    $prev = ($page > 1) ? $page - 1 : 1;
    $pagination .= "<li class='page-item'><button onclick='change_page($prev)' class='page-link shadow-none'>Prev</button></li>";

    // Next page button
    $next = ($page < $total_pages) ? $page + 1 : $total_pages;
    $pagination .= "<li class='page-item'><button onclick='change_page($next)' class='page-link shadow-none'>Next</button></li>";

    // Last page button
    if($page != $total_pages){
        $pagination .= "<li class='page-item'><button onclick='change_page($total_pages)' class='page-link shadow-none'>Last</button></li>";
    } else {
        $pagination .= "<li class='page-item disabled'><button class='page-link shadow-none'>Last</button></li>";
    }
}
    $output = json_encode(["table_data"=> $table_data,"pagination"=> $pagination]);

    echo $output;
}


if (isset($_POST['assign_room'])) {
    
    if(isset($_POST['room_no'], $_POST['ReservationID'])) {
        
        $query1 = "UPDATE `reservation` AS r
                  INNER JOIN `checkin` AS c ON r.ReservationID = c.ReservationID
                  INNER JOIN `reservationdetails` AS rd ON r.ReservationID = rd.ReservationID
                  INNER JOIN `roomtype` AS rt ON rd.RTID = rt.RTID
                  INNER JOIN `room` AS rm ON rt.RTID = rm.RTID
                  SET r.Room_No = ?,
                    r.ReservationStatus =?,
                      c.CheckInStatus = ?,
                      c.CheckInTime = CURRENT_TIMESTAMP()
                  WHERE r.ReservationID = ?";
        
        $stmt = mysqli_prepare($con, $query1);
        $status = 'Checked In';
        $reservationID = $_POST['ReservationID'];
        $re_status = 'ASSIGNED';
        mysqli_stmt_bind_param($stmt, "sssi", $_POST['room_no'],$re_status , $status, $reservationID);
        
        
        if(mysqli_stmt_execute($stmt)) {
            
            $query_room = "UPDATE `room` SET RoomStatus = 0 WHERE RoomNumber = ? ";
            $stmt_room = mysqli_prepare($con, $query_room);
            mysqli_stmt_bind_param($stmt_room, "s", $_POST['room_no']);
            mysqli_stmt_execute($stmt_room);
            
            
            echo 1;
        } else {
            
            echo 0;
        }
    } else {
       
        echo "Required fields missing.";
    }
    
    exit;
}





// for room number associate with RTID
if (isset($_POST['RTID'])) {
    $RTID = $_POST['RTID'];
    $query = select("SELECT * FROM `room` INNER JOIN `roomtype` ON room.RTID = roomtype.RTID WHERE `room`.`RTID` = ? AND `room`.`RoomStatus` = ?", [$RTID, 1],'ii');
    $roomNumbers = [];
    
    while ($row = mysqli_fetch_assoc($query)) {
        $roomNumbers[] = $row;
    }

    // Return room numbers as JSON
    echo json_encode($roomNumbers);
    exit;
}


if (isset($_POST['cancel_reservation'])) {
    $frm_data = filtration($_POST);

    $query = "UPDATE `payment` AS p 
    INNER JOIN `checkout` AS c ON c.CheckOutID = p.CheckOutID
    INNER JOIN `reservation` AS r ON  r.ReservationID = c.ReservationID
    SET r.`ReservationStatus`=? , 
    p.`RefundAmount`=? 
    WHERE r.`ReservationID` =?;";
    $values = ['CANCELLED', 0, $frm_data['ReservationID']];

    $res = update($query, $values, 'sii');// it will update 2 rows so it will return 2

    echo ($res == 2) ? 1 : 0;
}

?>

