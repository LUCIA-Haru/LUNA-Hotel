<?php
require('../admin/files/db_config.php'); 
require('../admin/files/essentials.php'); 


if (isset($_GET['email_confirmation'])) {
    $data = filtration($_GET);
    $query = select("SELECT * FROM `customer` WHERE `CustomerEmail`=? AND `Token`=? LIMIT 1 ", [$data['email'], $data['token']], 'ss');

    if(mysqli_num_rows($query)==1){
        $fetch = mysqli_fetch_assoc($query);

        if ($fetch['Is_Verified']==1) {
            echo "<script>alert('Email already verified!')</script>";
        }else{
            $update = update("UPDATE `customer` SET `Is_Verified`=? WHERE `CustomerID` =?",[1,$fetch['CustomerID']],'ii');

            if($update){
                echo "<script>alert('Email verification success!')</script>";
            }else{
                echo "<script>alert('Email verification failed!')</script>";
            }
        }
        redirect('index.php');
    }else{
        echo "<script>alert('Invalid Link!')</script>";
        redirect('index.php');
    }
}
?>