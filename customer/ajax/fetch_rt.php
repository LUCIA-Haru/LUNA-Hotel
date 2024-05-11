<?php
require('../../admin/files/db_config.php'); 
require('../../admin/files/essentials.php'); 

date_default_timezone_set("Asia/Yangon");
session_start();



if (isset($_POST['rid'])) {
    $data = filtration($_POST);
    $room_res = select("SELECT * FROM `roomtype` WHERE `RTID` = ?", [$data['rid']], 'i');


    if(mysqli_num_rows($room_res)==0){
        exit("Room ID not specified");
    }
    $rt_data = mysqli_fetch_assoc($room_res);



    // Fetch images
    $images_res = select("SELECT * FROM `rt_images` WHERE `RTID` = ?", [$data['rid']], 'i');
    $images = [];
    while ($image_row = mysqli_fetch_assoc($images_res)) {
        $images[] = RT_IMG_PATH . $image_row['RTImages'];
    }

    // Combine room data and images
    $rt_data['images'] = $images;


    // features
    $features_res = select("SELECT f.FeatureName
                                FROM `feature` f 
                                INNER JOIN `rt_features` rtfea 
                                ON f.FeatureID = rtfea.FeatureID 
                                WHERE rtfea.RTID = ?", [$data['rid']], 'i');
    $features = [];
    while ($feature_row = mysqli_fetch_assoc($features_res)) {
        $features[] = $feature_row['FeatureName'];
    }
    $rt_data['features'] = $features;

    // amenities
    $amenities_res = select("SELECT a.AmenitiesName
                                FROM `amenities` a 
                                INNER JOIN `rt_amenities` rta 
                                ON a.AmenitiesID = rta.AmenitiesID 
                                WHERE rta.RTID = ?", [$data['rid']], 'i');

    $amenities = [];
    while ($amenities_row = mysqli_fetch_assoc($amenities_res)) {
        $amenities[] = $amenities_row['AmenitiesName'];
    }
    $rt_data['amenities'] = $amenities;

    echo json_encode($rt_data);
        
}

if (isset($_GET['fetch_rooms'])) {
    // check available of room type filter
    $chk_avail=json_decode($_GET['chk_avail'],true);

    if($chk_avail['checkin']!='' && $chk_avail['checkout']!=""){
        $today_date = new DateTime(date("Y-m-d"));
        $checkin_date = new DateTime($chk_avail['checkin']);
        $checkout_date = new DateTime($chk_avail['checkout']);

        if ($checkin_date == $checkout_date) {
             echo "<h3 class='text-center text-uppercase'>Invalid Dates!</h3>";
            exit;
        }else if($checkout_date < $checkin_date){
            echo "<h3 class='text-center text-uppercase'>Invalid Dates!</h3>";
            exit;
        } else if ($checkin_date < $today_date) {
            echo "<h3 class='text-center text-uppercase'>Invalid Dates!</h3>";
            exit;
        }
    }

    // check guests filter
    $guests = json_decode($_GET['guests'],true);
    $adults = ($guests['adult'] != '') ? $guests['adult'] : 1;
    $children = ($guests['children'] != '') ? $guests['children'] : 0;

    // features and amenities filter
   $feature_list = json_decode($_GET['feature_list'],true);
    $amenities_list = json_decode($_GET['amenities_list'],true);


    // count rooms and output variables to store room cards
    $count_rooms = 0;
    $output = "";

    // fetching setting table to check website is shutdown or not
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`='1'";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));

    // query for room cards
    $room_res = select("SELECT * FROM `roomtype` WHERE `Adult` >= ? AND `Children` >= ? AND `RTStatus` =?",[$adults,$children,1],'iii');

    // Session store for search data for reservation_details.php
    $_SESSION['search_data'] = [
        'checkin' => $chk_avail['checkin'],
        'checkout' => $chk_avail['checkout'],
        'adult' => $guests['adult'],
        'children' => $guests['children']
    ];

    
    while($room_data = mysqli_fetch_assoc(($room_res))){
        // Determine the animation class based on the position of the room card
    // $animationClass = $count_rooms % 2 === 0 ? 'gs_reveal_fromLeft' : 'gs_reveal_fromRight';
        

        // check available of room type filter
        if($chk_avail['checkin']!='' && $chk_avail['checkout']!=""){
            $tb_q = "SELECT 
            COUNT(reservation.ReservationID) AS `total_reservations`
            FROM 
                reservation
            INNER JOIN 
                checkIn ci ON reservation.ReservationID = ci.ReservationID
            INNER JOIN 
                checkOut co ON reservation.ReservationID = co.ReservationID
            INNER JOIN 
                reservationdetails rd ON reservation.ReservationID = rd.ReservationID
            INNER JOIN 
                roomType ro ON ro.RTID = rd.RTID
            WHERE 
                reservation.`ReservationStatus` = ?
                AND ro.`RTID` = ?
                AND co.`CheckOutDate` > ?
                AND ci.`CheckInDate` < ?
        ";
                $t_values = ['ASSIGNED',$room_data['RTID'],$chk_avail['checkin'],$chk_avail['checkout']];

                $tb_fetch = mysqli_fetch_assoc(select($tb_q, $t_values, 'siss'));

                

                if (($room_data['RTQuantity'] - $tb_fetch['total_reservations'])==0) {
                    continue;
                }
        }

        // get feature and amenities room with filter
        $fea_count = 0;
        $am_count = 0;

        // get features of rt
        $fea_q = mysqli_query($con,"SELECT f.FeatureName, f.FeatureID
            FROM `feature` f 
            INNER JOIN `rt_features` rtfea 
            ON F.FeatureID = rtfea.FeatureID 
            WHERE rtfea.RTID = '$room_data[RTID]'");

        $features_data = "";
            while($fea_row = mysqli_fetch_assoc($fea_q)){
            
                if(in_array(($fea_row['FeatureID']),$feature_list['Features'])){
                    
                    $fea_count++;
                }

                $features_data .= "<span class='badge rounded-pill bg-white text-dark text-wrap'>$fea_row[FeatureName]</span>";
            
            }
            if (count($feature_list['Features'])!= $fea_count) {
            continue;
            }
            // get Amenities
            $amenities_q = mysqli_query($con,"SELECT a.AmenitiesName, a.AmenitiesID
            FROM `amenities` a 
            INNER JOIN `rt_amenities` rta 
            ON a.AmenitiesID = rta.AmenitiesID 
            WHERE rta.RTID = '$room_data[RTID]'");

        $amenities_data = "";
        while ($amenity_row = mysqli_fetch_assoc($amenities_q)) {
            if(in_array(($amenity_row['AmenitiesID']),$amenities_list['Amenities'])){
            $am_count++;
            }

            $amenities_data .= "<span class='badge rounded-pill bg-white text-dark text-wrap'>$amenity_row[AmenitiesName]</span>";
        }
        if (count($amenities_list['Amenities'])!= $am_count) {
            continue;
            }
        // get thumbail of image
        $room_thumb = RT_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con,"SELECT * FROM `rt_images` WHERE `RTID` = '$room_data[RTID]' AND `Active` = '1'");

        if(mysqli_num_rows($thumb_q)>0){
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = RT_IMG_PATH . $thumb_res['RTImages'];
        }

        // shutdown feature to stop reservation
        
        $book_btn = "";
        if (!$settings_r['shutdown']) {
            $login = 0;
            if (isset($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
                $login = 1;
            }
            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[RTID])' class='btn custom-btn col-md-12 col-lg-6'>Book Now</button> ";
            
        }
        // rating
        $rating_q = "SELECT AVG(Rating) AS `avg_rating` FROM `reviews` WHERE `RTID` = '$room_data[RTID]' ORDER BY `RTID` DESC LIMIT 20";

        $rating_res = mysqli_query($con, $rating_q);
        $rating_fetch = mysqli_fetch_assoc($rating_res);

        $rating_data = "";

        if($rating_fetch['avg_rating'] != NULL){
            $rating_data = "<div class='rating mb-4'>
            
            <span class='badge rounded-pill bg-white text-dark text-wrap'>
            ";
            for ($i=0; $i < $rating_fetch['avg_rating'] ; $i++) {
            $rating_data .= " <i class='bi bi-star-fill text-warning'></i>";
            }
            $rating_data .= "</span>
            </div>";
        }
        
        // print room card
        $output.="
        
                <div class='col-lg-10 col-md-6 mb-4 fade-in'>
                    <div class='rt-card border-0 justify-content-center '>
                        <div class='g-0 p-3 d-lg-flex align-items-center justify-content-center'>
                            <span class='card-bg'></span>
                            <div class='col-md-12 col-lg-6 col-xl-5 me-xl-2'>
                                <img src='$room_thumb' alt='roomtype' class='card-img image-fluid shadow'>
                            </div>
                            <div class='col-md-12 col-lg-5 col-xl-4 '>
                                <h3 class='rt-name '>$room_data[RTName]</h3>
                                <div class='features mb-3'>
                                    <h6 class='mb-1'>Features</h6>
                                    $features_data
                                </div>
                                
                                <div class='guests mb-3'>
                                    <h6 class='mb-1'>Guests</h6>
                                    <span class='badge rounded-pill bg-white text-dark text-wrap'>$room_data[Adult] Adults</span>
                                    <span class='badge rounded-pill bg-white text-dark text-wrap'>$room_data[Children] Children</span>
                                </div>
                                <div class='rating mb-3'>
                                    <h6 class='mb-1'>Rating</h6>
                                    $rating_data
                                    </span>
                                    <h6 class='mb-3 price'><b>$$room_data[PricePerNight]</b> per night</h6>
                                </div>
                            </div>
                            <div class='card-footer  col-md-12 col-lg-4 col-xl-3 ms-lg-5 d-sm-flex  justify-content-md-around  flex-md-column'>
                                                                                                                $book_btn
                                
                                <a href='#' class='rt-detail design-link  col-md-12 col-lg-6' data-roomid='$room_data[RTID]' data-bs-toggle='modal' data-bs-target='#rt_details'>
                                    <div class='design-link-container'>
                                        <div class='mask'>
                                            <span class='link-design design_link1'>More Details</span>
                                            <span class='link-design design_link2'>More Details</span>
                                        </div>
                                    </div>
                                        <i class='bi bi-arrow-right'></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
        ";
        $count_rooms++;
    }
    if($count_rooms>0){
        echo $output;
    }else{
        echo "<h3 class='text-center'>No rooms to shown!</h3>";
    }
}

?>