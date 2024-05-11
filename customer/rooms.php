
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNA</title>
    <?php require('./files/links.php') ?>
       

</head>
<body>
<!-- Header links -->
<?php 
require('files/header.php');

$checkin_default = "";
$checkout_default = "";
$adult_default = "1";
$children_default = "0";

if (isset($_GET['check_availability'])) {
    $frm_data = filtration($_GET);
    $checkin_default = $frm_data['checkIn'];
    $checkout_default = $frm_data['checkOut'];
    $adult_default = $frm_data['adult'];
    $children_default = $frm_data['children'];
}





?>
<!-- Main section start -->
<main class="c_main">
           
    <!-- Search search Section Start -->
        <section class="room-search availability-form text-center mb-4 fade-in">
            <!-- breadcrumb start -->

            <nav class="breadcrumb_container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item font-t text-uppercase"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active  font-t text-uppercase" aria-current="page">rooms</li>
                </ol>
            </nav>

            <!-- breadcrumb end -->
            <div class="container-fluid rooms_search_container">
                <div class="row ">
                    <div class="search-form col-xl-10 col-lg-9 col-md-10 col-12 p-2 rounded mx-auto ">
                        <form method="POST" id="search_filter_form">
                            <div class="row d-flex align-item-center inset-card">
                                <div class="col-sm-6 col-md-3 col-xs-12  mb-3">
                                    <label class="form-label check">Check-in</label>
                                    <input onchange="chk_avail_filter()" type="date" id="checkIn" class="form-control shadow-none" value="<?php echo $checkin_default ?>" name="checkin">
                                </div>
                                <div class="col-sm-6 col-md-3 col-xs-12  mb-sm-3">
                                    <label class="form-label check">Check-out</label>
                                    <input type="date"  onchange="chk_avail_filter()" id="checkOut" class="form-control shadow-none" value="<?php echo $checkout_default ?>" name="checkout"> 
                                </div>
                                <!-- Guests -->
                                <div class="col-sm-6 col-md-3 col-xs-12  mb-3">
                                    <label class="form-label check">Adult</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                        <input type="number" class="form-control" id="adultInput" name="adult" value="<?php echo $adult_default ?>" min="1" max="8" oninput="guests_filter()">
                                        <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3 col-xs-12 mb-sm-3">
                                    <label class="form-label check">Children</label>
                                    <div class="input-group d-flex">
                                        <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                        <input type="number" class="form-control" id="childrenInput" name="children" value="<?php echo $children_default ?>" min="0" max="8" oninput="guests_filter()">
                                        <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <button id="chk_avail_btn" type="reset" class="btn btn-sm btn-reset d-none" >Reset</button>
                                    
                                </div>
                                <!-- <?php
                                
                                // Add the fetched data to session variables
                                $_SESSION['search_data'] = [
                                    'checkin' => $checkin_default,
                                    'checkout' => $checkout_default,
                                    'adult' => $adult_default,
                                    'children' => $children_default
                                ]; 
                                ?> -->
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

        <!-- Search search Section End -->
        <!-- progress start -->
        <div class="progress-wrapper fade-in">
            <div class="progress_container">
                <ul class="progressbar">
                    <li class="active">Select Rooms</li>
                    <li>Special Request</li>
                    <li>Confirm Reservation</li>
                </ul>
            </div>
        </div>
        <!-- progress end -->
        <!-- Filter & Room Section Start -->
            <section class="filter-room fade-in">
                <!-- Filter Section Start -->
            
                <div class="filter col-lg-4 col-md-2">
                    <!-- Button trigger modal -->
                    <button type="button" id="filterBtn"  class="btn btn-color2 p-1" data-bs-toggle="modal" data-bs-target="#filter">
                        <i class="bi bi-sliders2"></i>Filter
                    </button>

                    
                </div>
                
                <!-- Filter Section End -->
                <!-- Room Section Start -->
                <h2 class="main-title text-center text-uppercase gs_reveal ">Rooms</h2>
                <div class="h-line s-line"></div>
                <div class="container mb-3 rooms__container">
                    <div class="row d-flex justify-content-center" id="rooms_list">
                        
                        
                     

                    </div>
                </div>
                <!-- Room Section End -->

            </section>
        <!-- Filter & Room Section End -->
        <!-- Filter Modal start -->
        <div class="modal fade z-model" id="filter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h3 class="modal-title" > Filter </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="search_filter_form" >
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="inset-card">
                                        <h3>Features</h3>
                                        <?php
                                            $features_q = selectAll('feature');
                                            $counter = 0; 

                                            while ($row = mysqli_fetch_assoc($features_q)) {
                                                // If the counter is divisible by 2, start a new row
                                                if ($counter % 2 == 0) {
                                                    echo '<div class="row">';
                                                }

                                                echo <<<feature
                                                    <div class="col-6">
                                                        <div class="mb-2">
                                                            <input type="checkbox" name="feature"  class="form-check-input shadow-none me-1" id="{$row['FeatureID']}" onclick="fetch_room_filter()" value="{$row['FeatureID']}">
                                                            <label class="form-check-label" for ="{$row['FeatureID']}"> {$row['FeatureName']}</label>
                                                        </div>
                                                    </div>
                                                feature;

                                                $counter++;

                                                // If the counter is divisible by 2, close the row
                                                if ($counter % 2 == 0) {
                                                    echo '</div>'; 
                                                }
                                            }

                                            // If there are an odd number of features, close the last row
                                            if ($counter % 2 != 0) {
                                                echo '</div>'; 
                                            }
                                        ?>

                                    </div>
                                    <div class="inset-card mt-3">
                                        <h3>Amenities</h3>
                                        <?php
                                            $amenities_q = selectAll('amenities');
                                            $counter = 0; 
                                            while ($row = mysqli_fetch_assoc($amenities_q)) {
                                                if ($counter % 2 == 0) {
                                                    echo '<div class="row">';
                                                }
                                                echo <<<amenities
                                                    <div class="col-6 mb-2">
                                                        <input type="checkbox" name="amenities" class="form-check-input shadow-none me-1" id="{$row['AmenitiesID']}" onclick="fetch_room_filter()" value="{$row['AmenitiesID']}">
                                                        <label class="form-check-label" for="{$row['AmenitiesID']}"> $row[AmenitiesName]</label>
                                                    </div>
                                                amenities;
                                                $counter++;
                                                if ($counter % 2 == 0) {
                                                        echo '</div>'; 
                                                    }
                                            }
                                            if ($counter % 2 != 0) {
                                                echo '</div>'; 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button id="chk_filter_btn" type="reset" class="btn btn-sm btn-reset d-none" onchange="chk_filter_clear()">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter Modal start -->


      

        <!-- Details Modal start -->
        <div class="modal fade z-model" id="rt_details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h3 class="modal-title" id="rt-Title">  Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="rt-body">
                            
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Details Modal start -->
        
</main>
<!-- chatbot section start -->
<?php require('./chatbot.php');?>    
<!-- chatbot section end -->
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>
<!-- footer -->
<?php require('files/footer.php');?>
<script src="./js/rt_details.js"></script>


</body>
</html>