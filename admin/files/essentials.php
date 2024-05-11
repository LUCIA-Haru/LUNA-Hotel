<?php
// Frontend purpose  data
define('SITE_URL', 'http://127.0.0.1/ProgramPractice/LUNA/');
define('ADMIN_IMG_PATH', SITE_URL . 'assets/admin/');
define('AMENITIES_IMG_PATH', SITE_URL . 'assets/amenities/');
define('RT_IMG_PATH', SITE_URL . 'assets/roomtype/');
define('CUSTOMER_IMG_PATH', SITE_URL . 'assets/customer/');

// backend upload process needs this data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/ProgramPractice/LUNA/assets/');
define('ADMIN_FOLDER',  'admin/');
define('AMENITIES_FOLDER',  'amenities/');
define('RT_FOLDER',  'roomtype/');
define('CUSTOMER_FOLDER',  'customer/');


// sendgrid api key

define('SENDGRID_API_KEY','');//Add SendGrid API key
define('SENDGRID_EMAIL','luciaharu01@gmail.com');
define('SENDGRID_NAME','LUCIA');


function adminLogin(){
        session_start();
        if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)) {
                echo "
                    <script>
                        window.location.href='a_login.php'; 
                        
                    </script>    
                ";
                exit;
        }
    
    }


/* window.location.href: Represents the current URL of the  browser.
    '$url': Represents a JavaScript variable containing a URL as a string.
    So, the statement is setting the window.location.href property to the value of the $url variable, effectively redirecting the browser to the specified URL.*/
    function redirect($url){
        echo "
            <script>
                window.location.href='$url'; 
                
            </script>    
        ";
    exit;
    }
   function redirectWithDelay($url, $delay) {
    echo "
        <script>
            setTimeout(function() {
                window.location.href = '$url';
            }, $delay);
        </script>
    ";
    exit;
    }

    
    // alert message
    function alert($type,$msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
            <div class="alert $bs_class alert-warning alert-dismissible fade show custom-alert" id="cus_alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

// Image
function uploadImage($image, $folder) {
    $allowed_mime_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $img_mine = mime_content_type($image['tmp_name']); // Get MIME type using file contents

    if (!in_array($img_mine, $allowed_mime_types)) {
        return 'invalid_img'; // invalid image MIME type
    } else if (($image['size'] / (1024 * 1024)) > 2) {
        return 'invalid_size'; // invalid size greater than 2MB
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext"; // IMG_9528.png
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upload_failed';
        }
    }
}


function deleteImage($image,$folder){
    if(unlink(UPLOAD_IMAGE_PATH . $folder . $image)){
        return true;
    }
    else{
        return false;
    }
}

  function uploadSVGImage($image, $folder) {
    $valid_mine = ['image/svg+xml'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'invalid_img'; // invalid image mine or format
    } else if (($image['size'] / (1024 * 1024)) > 2) {
        return 'invalid_size'; // invalid size greater than 2MB
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext"; // IMG_9528.png
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upload_failed';
        }
    }
}

function uploadUserImage($image){
    $valid_mine = ['image/jpeg','image/jpg',  'image/png', 'image/webp'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'invalid_img'; // invalid image mine or format
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";

        $img_path = UPLOAD_IMAGE_PATH . CUSTOMER_FOLDER . $rname;

        if($ext == "png" || $ext == "PNG"){
            $img = imagecreatefrompng($image['tmp_name']);
        }else if($ext == "webp" || $ext == "WEBP"){
            $img = imagecreatefromwebp( $image["tmp_name"] );
        }else{
            $img = imagecreatefromjpeg( $image["tmp_name"] );
        }
        //imagejpeg -> builtin function
        if (imagejpeg($img,$img_path,75)) {
            return $rname;
        } else {
            return 'upload_failed';
        }
    }
}

?>