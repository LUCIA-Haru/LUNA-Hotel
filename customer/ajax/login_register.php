<?php 
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 
require('../files/sendgrid-php/sendgrid-php.php');
date_default_timezone_set("Asia/Yangon"); 


// sendgrid
function send_mail($cemail,$token,$type){

    if ($type == "email_confirmation") {
        $page = 'customer/email_confirm.php';
        $subject = "Account Verification Link";
        $content = "confirm your email";
    }else{
        $page = 'customer/index.php';
        $subject = "Account Reset Link";
        $content = "reset your account";
    }

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom(SENDGRID_EMAIL,SENDGRID_NAME);
    $email->setSubject("$subject");
    $email->addTo($cemail);
    $email->addContent(
        "text/html", "Click the link to $content: <br>
        <a href='" . SITE_URL . "$page?$type&email=$cemail&token=$token'>Click here</a>"
    );


    
    $sendgrid = new \SendGrid(SENDGRID_API_KEY);
    if($sendgrid->send($email)){
        return 1;
    }else{
        return 0;
    };
   
}


if(isset($_POST['register'])){
    $data = filtration($_POST);

    // match password and confirm password
    if($data['pass'] != $data['confirm']){
        echo 'pass_mismatch';
        exit;
    }
    // Check if user exists by email, phone number, (NRC, or passport is filled)
    $whereClause = "(`CustomerEmail`=? OR `CustomerPhoneNo`=? OR (`CustomerNRC`=? AND `CustomerNRC`<>'') OR (`PassportNo`=? AND `PassportNo`<>''))";
    $u_exist = select("SELECT * FROM `customer` WHERE $whereClause LIMIT 1", [$data['email'], $data['ph'], $data['NRC'], $data['passport']], 'ssss');

    if(mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if($u_exist_fetch['CustomerEmail'] == $data['email']) {
            echo 'email_already';
        } elseif($u_exist_fetch['CustomerPhoneNo'] == $data['ph']) {
            echo 'phone_already';
        } elseif($u_exist_fetch['CustomerNRC'] == $data['NRC']) {
            echo 'nrc_already';
        } elseif($u_exist_fetch['PassportNo'] == $data['passport']) {
            echo 'passport_already';
        }
        exit;
    }



    // upload user image to server
    $img = uploadUserImage($_FILES['pic']);

    if($img == 'invalid_img'){
        echo 'invalid_img';
        exit;
    }else if($img == 'upload_failed'){
        echo 'upload_failed';
        exit;
    }

    // send confirmation link to user's email
    $token = bin2hex(random_bytes(16));


    if(!send_mail($data['email'],$token, "email_confirmation")){
        echo 'mail_failed';
        exit;
    };
    // encrypt password
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `customer`( `CustomerFullName`, `Gender`, `CustomerEmail`, `CustomerPhoneNo`, `CustomerDOB`, `CustomerNRC`,`PassportNo`, `Street`, `Township`, `City`, `Country`, `PostalCode`,  `Password`, `ProfilePic`,  `Token`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'],$data['gender'],$data['email'],$data['ph'],$data['dob'],$data['NRC'],$data['passport'],$data['street'],$data['town'],$data['city'],$data['country'],$data['postal'],$enc_pass,$img,$token];
    
    if(insert($query,$values,'sssssssssssisss')){
        echo 1;
    }
    else{
        echo 'ins_failed';
    }
}

if(isset($_POST['c_login'])){
    $data = filtration($_POST);

    $u_exist = select("SELECT * FROM `customer` WHERE `CustomerEmail` =? OR `CustomerPhoneNo`=? LIMIT 1",[$data['email_mob'],$data['email_mob']],'ss');
    
    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob';
        
    }else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['Is_Verified']==0){
            echo 'not_verified';
        }else if($u_fetch['CustomerStatus']==0){
            echo 'inactive';
        }else{
            if(!password_verify($data['login_pass'],$u_fetch['Password'])){
                echo 'invalid_pass';
            }else{
                session_start();
                $_SESSION['c_login'] = true;
                $_SESSION['uId']= $u_fetch['CustomerID'];
                $_SESSION['uName']= $u_fetch['CustomerFullName'];
                $_SESSION['uPic']= $u_fetch['ProfilePic'];
                $_SESSION['uPh']= $u_fetch['CustomerPhoneNo'];
                $_SESSION['uemail']= $u_fetch['CustomerEmail'];
                echo 1;
            }
        }
    }
}
if(isset($_POST['forgot_pass'])){
    $data = filtration($_POST);

    $u_exist = select("SELECT * FROM `customer` WHERE `CustomerEmail` =? LIMIT 1",[$data['forgot_email']],'s');
    
    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email';
       
    }else{
         $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['Is_Verified']==0){
            echo 'not_verified';
        }else if($u_fetch['CustomerStatus']==0){
            echo 'inactive';
        }else{
            // send reset email link
            $new_token = bin2hex(random_bytes(16));

            if(!send_mail($data['forgot_email'], $new_token, "account_recovery")){
                echo "mail_failed";
            }else{
                $date = date("Y-m-d");

                $query = mysqli_query($con, "UPDATE `customer` SET `Token`='$new_token',`T_Expire`='$date' WHERE `CustomerID`='$u_fetch[CustomerID]'");

                if($query){
                    echo 1;
                }else{
                    echo 'upd_failed';
                }
            };
        }
    }
}
if(isset($_POST['recovery_pass'])){
    $data = filtration($_POST);

    $enc_pass = password_hash($data['new_pass'], PASSWORD_BCRYPT);

    $query = "UPDATE `customer` SET `Password`=?, `Token`=?,`T_Expire`=? WHERE `CustomerEmail`=? AND `Token`=?";

    $values = [$enc_pass, null, null, $data['email'], $data['token']];
    if (update($query,$values,'sssss')) {
        echo 1;
    }else{
        echo 'failed';
    }
}
?>