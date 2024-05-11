<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 
 
date_default_timezone_set("Asia/Yangon");
session_start();

if (!isset ($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
    redirect('index.php');
}

if (isset($_POST['cancel_reservations'])) {
    $frm_data = filtration($_POST); 

    $query = "UPDATE `reservation` 
              SET `ReservationStatus` = ?
              WHERE `ReservationID` = ?";

    $values = ['CANCELLED', $frm_data['id']];

    $result = update($query, $values, 'si');
    echo $result ? 1 : 0;
}

?>