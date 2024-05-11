<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 

date_default_timezone_set("Asia/Yangon");



        
    session_start();
    $_SESSION['booking'];
    $_SESSION['room'];


if (isset($_POST['pay_now'])) {
    $frm_data = filtration($_POST);
    var_dump($_POST);

    $ReservationNo = 'R_c'.$_SESSION['uId'].random_int(11111,9999999);
    $flag = 0;

    $q1 = "INSERT INTO `reservation`(`ReservationNo` ,`ArrivalTime`, `SpecialRequest`) VALUES (?,?,?)";

    

    $values = [$ReservationNo,$_SESSION['booking']['arrival'],$_SESSION['booking']['special_request']];

    if (insert($q1, $values, 'sss')) {
        $flag = 1;

        // Get the auto-generated ReservationID
        $reservationID = mysqli_insert_id($con);

        // Insert data into the reservationdetails table
        $q2 = "INSERT INTO `reservationdetails`(`ReservationID`, `RTID`) VALUES (?, ?)";
        $values2 = [$reservationID, $_SESSION['room']['id']];
        if (insert($q2, $values2, 'ii')) {
            
            $flag = 1;
        } else {
            
            $flag = 0;
            die('Error inserting data into reservationdetails table!');
        }
        


        // checkin
        if ($flag) {
            $q3 = "INSERT INTO `checkin`( `CheckInDate`, `CustomerID`, `ReservationID`) VALUES (?,?,?)";
            $values3 = [$_SESSION['booking']['check_in'],$_SESSION['uId'],$reservationID];

            if (insert($q3, $values3, 'sii')) {
                $flag = 1;
            } else {
                $flag = 0;
                echo "Failed to add data to checkin table.";
            }
        }

        // checkout
        if ($flag) {
            $q4 = "INSERT INTO `checkout`( `CheckOutDate`, `ReservationID`) VALUES (?,?)";
            $values4 = [$_SESSION['booking']['check_out'],$reservationID];


            if (insert($q4, $values4, 'si')) {
            $flag = 1;
            // Retrieve the auto-generated CheckOutID
            $checkOutID = mysqli_insert_id($con);
            } else {
                $flag = 0;
                echo "Failed to add data to checkout table.";
            }
        }

        if ($flag) {
            $totalAmount = $_SESSION['booking']['totalAmount'];
            $taxServiceCharges = $_SESSION['booking']['tax&Servicecharges'];
            $grandTotal = $_SESSION['booking']['GrandTotal'];
            $transactionNo = $frm_data['transactionNo'];
            $transactionDate = $frm_data['transactionDate'];
            $transactionStatus = $frm_data['transactionStatus'];
            
            if ($checkOutID) {
                $q5 = "INSERT INTO `payment`(  `TransactionNo`, `TransactionDate`, `TransactionStatus`, `TotalAmount`, `Tax_Service_Charges`, `GrandTotal` ,`CheckOutID`) VALUES (?,?,?,?,?,?,?)";
                $values5 = [$transactionNo, $transactionDate, $transactionStatus, $totalAmount, $taxServiceCharges, $grandTotal, $checkOutID];

                if (insert($q5,$values5,'sssiiii' )) {
                    $flag = 1;
                    // Update Reservation Table
                    if ($transactionStatus == "COMPLETED") {
                        $q6 = "UPDATE `reservation` SET `ReservationStatus`= ? WHERE `ReservationID`=?";
                        $values6 = ["CONFIRMED", $reservationID];

                        if (update($q6, $values6, "si")) {
                            $flag = 1;
                            
                        }
                    }
                }else{
                    $flag = 0;
                    echo "Failed to add data to payment table.";
                }
            }else{
                $flag = 0;
                echo "Error: Failed to retrieve CheckOut ID. Please try again later.";
            }
        }


    }else{
        $flag = 0;
        echo "Error: Failed to add data.";
    }

     echo $flag ? 'Success' : 'Failed';
    

}
?>