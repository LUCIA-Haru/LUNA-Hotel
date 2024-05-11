<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 
 
date_default_timezone_set("Asia/Yangon");
session_start();

if (!isset ($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
    redirect('index.php');
}

if (isset($_POST['review_form'])) {
    $frm_data = filtration($_POST);

    $upd_query = "UPDATE `reservation` SET `Review_Rate_status`=? WHERE `ReservationID`=?";
    $upd_values = [1, $frm_data['reservation___id']];
    $upd_result = update($upd_query, $upd_values, 'ii');


    $query = "INSERT INTO `reviews` (`Rating`, `Reviews`,`CustomerID`, `ReservationID`, `RTID`) VALUES (?,?,?,?,?)";

    $values = [$frm_data['rating'], $frm_data['review'], $_SESSION['uId'], $frm_data['reservation___id'], $frm_data['room___id']];

    $result = insert($query, $values, 'isiii');
    echo $result;
    

}

?>