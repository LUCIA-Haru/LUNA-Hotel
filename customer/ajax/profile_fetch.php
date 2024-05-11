<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 
 
date_default_timezone_set("Asia/Yangon");

if (isset($_POST['personal_info_form'])) {
    $frm_data = filtration($_POST);
    session_start();

     $u_exist = select("SELECT * FROM `customer` WHERE (`CustomerEmail`=? OR `CustomerPhoneNo`=?) AND `CustomerID`!=? LIMIT 1
", [$frm_data['email'],$frm_data['ph'],$_SESSION['uId']], 'ssi');

     if(mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if($u_exist_fetch['CustomerEmail'] == $frm_data['email']) {
            echo 'email_already';
        } elseif($u_exist_fetch['CustomerPhoneNo'] == $frm_data['ph']) {
            echo 'phone_already';
        } 
        exit;
    }
    // Insert data into user table
    $query = "UPDATE `customer` SET `CustomerFullName`=?,`CustomerEmail`=?,`CustomerPhoneNo`=?,`CustomerDOB`=?,`Street`=?,`Township`=?,`City`=?,`Country`=?,`PostalCode`=? WHERE `CustomerID`=? LIMIT 1";
    $values = [$frm_data['name'],$frm_data['email'],$frm_data['ph'],$frm_data['dob'],$frm_data['street'],$frm_data['town'],$frm_data['city'],$frm_data['country'],$frm_data['postalcode'],$_SESSION['uId']];

    if(update($query,$values,'ssssssssis')){
        $_SESSION['uName'] = $frm_data['name'];
        echo 1;
    }else{
        echo 0;
    }
}
if (isset($_POST['profile_form'])) {

    session_start();

    

    // fetching old img and deleting it
     $u_exist = select("SELECT `ProfilePic` FROM `customer` WHERE  `CustomerID` =? LIMIT 1
", [$_SESSION['uId']], 'i');
    $u_fetch = mysqli_fetch_assoc($u_exist);

    deleteImage($u_fetch['ProfilePic'], CUSTOMER_FOLDER);

     // upload user image to server
    $img = uploadUserImage($_FILES['profile']);

    if($img == 'invalid_img'){
        echo 'invalid_img';
        exit;
    }else if($img == 'upload_failed'){
        echo 'upload_failed';
        exit;
    }

    $query = "UPDATE `customer` SET `ProfilePic`=? WHERE `CustomerID`=? LIMIT 1";
    $values = [$img,$_SESSION['uId']];

    if(update($query,$values,'si')){
        $_SESSION['uPic'] = $img;
        echo 1;
    }else{
        echo 0;
    }
}

if (isset($_POST['pass_form'])) {
    $frm_data = filtration($_POST);
    session_start();

    if ($frm_data['new_pass'] != $frm_data['confirm_pass']) {
        echo 'mismatch';
        exit;
    }

    // encrypt password
    $enc_pass = password_hash($frm_data['new_pass'], PASSWORD_BCRYPT);

     
    // Insert data into user table
    $query = "UPDATE `customer` SET `Password`=? WHERE `CustomerID`=? LIMIT 1";
    $values = [$enc_pass,$_SESSION['uId']];

    if(update($query,$values,'ss')){
        
        echo 1;
    }else{
        echo 0;
    }
}
?>