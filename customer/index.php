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
<?php require('files/header.php');?>

<!-- Main section start -->
<main class="c_main">
    <div class="preloader" id="preloader">
        <div class="box">
            <p>LUNA</p>
            <div class="box-clip"></div>
            <div class="box-clip2"></div>
        </div>
    </div>
    <!-- slider & search start -->
    <section class="slider-banner" id="slider-banner">
        <div class="slider-container" id="slider-container">
            <div class="index_slide active" id="slide">
                <img src="../assets/img/carousel/c1.jpg" alt="carousel">
                <div class="slider-text-container">
                    <div class="slide-number-container">
                        <div class="number-wrap">1</div>
                        <span class="slide-number-small">/ 06</span>
                    </div>
                    <div class="slide-title-container">
                        <div class="title-wrap text-uppercase">
                            <h3 class="slide-title">Welcome to luna</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="slide-info-container">
            <div class="slide-info-text">
                <div class="slide-info-wrap"><i class="bi bi-mouse"></i></div>
               
                <h4>Scroll Down</h4>
            </div>
            <div class="slide-info-box">
                     <div class="room-search availability-form text-center mb-4 ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="search-form col-xl-10 col-lg-9 col-md-10 col-12 p-2 rounded mx-auto mt-3 inset-card">
                                    <form action="rooms.php" method="GET">
                                        <div class="row align-item-center">
                                            <div class="col-6 col-md-3 col-sm-3 col-xl-3 mb-3">
                                                <label class="form-label check">Check-in</label>
                                                <input type="date" class="form-control shadow-none" name="checkIn" required>
                                            </div>
                                            <div class="col-6 col-md-3 col-sm-3 col-xl-3 mb-sm-3">
                                                <label class="form-label check">Check-out</label>
                                                <input type="date" class="form-control shadow-none" name="checkOut" required>
                                            </div>
                                            <div class="col-6 col-md-3 col-sm-2 col-xl-2 mb-3">
                                                <label class="form-label check">Adult</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                                    <input type="number" class="form-control" id="adultInput" value="1" min="0" max="8" name="adult" required>
                                                    <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-3 col-sm-2 col-xl-2 mb-sm-3">
                                                <label class="form-label check">Children</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary decrementBtn" type="button">-</button>
                                                    <input type="number" class="form-control" id="childrenInput" value="0" min="0" max="8" name="children" >
                                                    <button class="btn btn-outline-secondary incrementBtn" type="button">+</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="check_availability">
                                            <div class="col-sm-1 col-md-12 col-lg-12 col-xl-2 index_search_btn">
                                                <button type="submit" class="btn mt-sm-4 btn-color2 shadow-none">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>           
            </div>
        </div>
    </section>
    <!-- slider & search end-->
    <!-- mini about start -->
    
    <section class="mini-about fade-in">
        <div class="mini-about-container" >
            <div class="container-fluid">
                
                <div class="bg" >
                    <h2 class="main-title text-center text-uppercase mt-3">LUNA</h2>
                    <div class="h-line s-line"></div>
                    <div class="row">
                        <div class="mini-about-img-container col-12 col-md-5 d-flex align-item-center justify-content-center gs_reveal gs_reveal_fromLeft">
                            <span class="img-bg"></span>
                            <img src="../assets/img/aboutsection.jpg" alt="aboutus" class="mini-about-img">
                        </div>
                        <div class="mini-about-text-container col-12 col-md-7 inset-card display__info gs_reveal gs_reveal_fromRight">
                            <h5 class="mini-title text-uppercase" >Modern and luxury </h5>
                           <div class="">
                                <p class="mini-about-text">
                                    "At <span class="brand-name">LUNA</span> , we redefine the essence of modern luxury, where sophistication meets unparalleled comfort. Nestled in the heart of <b>KALAW</b>, our boutique hotel offers a sanctuary of contemporary elegance. From our meticulously designed interiors to our personalized<span class="dots">...</span
                                    ><span class="more">
                                         service, every detail is crafted to exceed your expectations. Whether you're here for business or leisure, indulge in a world where opulence and innovation intertwine seamlessly. Welcome to a place where luxury knows no bounds, and every moment is an experience to cherish."
                                    </span>
                                    <button class="readmore btn-color">Read more</button>
                                </p>
                           </div>
                            <a href='about.php' class='design-link mb-4'>
                                <div class='design-link-container'>
                                    <div class='mask'>
                                        <span class='link-design design_link1'>Learn More</span>
                                        <span class='link-design design_link2'>Learn More</span>
                                    </div>
                                </div>
                                    <i class='bi bi-arrow-right'></i>
                            </a>
                        </div>
                        <div class="wave-bottom-divider col-12">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- mini about end -->
    <!-- mini rooms start -->
    <section class="mini-room" >
        <h2 class="main-title text-center text-uppercase">Available Rooms</h2>
                <div class="h-line s-line"></div>
        <div class="mini-room-container shrink2">
            <div class='slider '>
                <?php
                    $room_res = select("SELECT * FROM `roomtype` WHERE `RTStatus` = ? ORDER BY `RTID` DESC", [1], 'i');
                    $count_rooms = 0;
    
                    // Loop through each room type
                    foreach($room_res as $room_data) {
                        // Get thumbnail image for the room type
                        $room_thumb = RT_IMG_PATH . "thumbnail.jpg";
                        $thumb_q = mysqli_query($con, "SELECT * FROM `rt_images` WHERE `RTID` = '{$room_data['RTID']}' AND `Active` = '1'");
    
                        if(mysqli_num_rows($thumb_q) > 0){
                            $thumb_res = mysqli_fetch_assoc($thumb_q);
                            $room_thumb = RT_IMG_PATH . $thumb_res['RTImages'];
                        }
                ?>
                        <div class='slider__item d-flex ' style='background-image: url("<?php echo $room_thumb?>")'>
                            <div class='slider__text'>
                                <p><?php echo $room_data['RTName']?></p>
                                <p><?php echo $room_data['RTDescription']?></p>
                                
                            </div>
                        </div>
                <?php
                        $count_rooms++;
                    }
                ?>
                <div class='slider__arrows'>
                    <div class='slider__arrows--left'>&#10094;</div>
                    <div class='slider__arrows--right'>&#10095;</div>
                </div>
            </div>

        </div>
    </section>
    <!-- mini room end-->
    <!-- service start -->
    <section class="mini-service blur-bottom">
        <h2 class="main-title text-center text-uppercase gs_reveal "> meetings & events </h2>
        <div class="h-line s-line"></div>
        <div class="container-fluid mini-service-container">
            <div class="row event d-sm-flex align-item-center">
                <div class="col-sm-6">
                    <div class="service-text_container ">
                        <h3 class="mini-title text-uppercase gs_reveal ">Celebrations</h3>
                        <p class="service-text reveal-type gs_reveal gs_reveal_fromLeft" data-bg-color="#cccccc" data-fg-color="black">

                        "At <span class="brand-name">LUNA</span>, we specialize in creating unforgettable wedding experiences tailored to your dreams.  Let us turn your vision into reality and create lifelong memories on your special day. "
                        </p>
                        <a href='events.php' class='design-link mb-4'>
                            <div class='design-link-container'>
                                <div class='mask'>
                                    <span class='link-design design_link1'>Learn More</span>
                                    <span class='link-design design_link2'>Learn More</span>
                                </div>
                            </div>
                                <i class='bi bi-arrow-right'></i>
                        </a>
                    </div>
                </div>

               
            
                <div class="col-sm-5 gs_reveal gs_reveal_fromRight">
                    <div class="service-img_container">
                        <img src="../assets/events/e5.jpg" alt="wedding">
                    </div>
                </div>
            </div>
             <div class="section-divider d-sm-none d-xs-block">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>
            <div class="row meeting d-sm-flex justify-sm-content-around align-item-center">
                <div class="col-sm-6 gs_reveal gs_reveal_fromLeft">
                    <div class="meeting-img_container">
                        <img src="../assets/events/m1.jpg" alt="meeting">
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="meeting-text_container ">
                        <h3 class="mini-title text-uppercase gs_reveal ">Meetings</h3>
                        <p class="meeting-text reveal-type gs_reveal gs_reveal_fromRight" data-bg-color="#cccccc" data-fg-color="black">

                        "Elevate your business gatherings with <span class="brand-name">LUNA</span>. Our state-of-the-art facilities and personalized services provide the perfect backdrop for productive meetings, conferences, and corporate events."
                        </p>
                        <a href='events.php' class='design-link mb-4'>
                            <div class='design-link-container'>
                                <div class='mask'>
                                    <span class='link-design design_link1'>Learn More</span>
                                    <span class='link-design design_link2'>Learn More</span>
                                </div>
                            </div>
                                <i class='bi bi-arrow-right'></i>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
        
    </section>
    <!-- service end -->
    <!--dining  start -->
    <section class="mini-dining  mt-4">
        <h2 class="main-title text-center text-uppercase gs_reveal ">Dining & Cafe</h2>
        <div class="h-line s-line"></div>
        <div class="mini-dining-container container-fluid">
            <div class="dining-card_container d-flex align-item-center justify-content-center mb-3">
                <div class="dining-card-stack ">
                    <!-- <div class="dining-card">
                        <img src="../assets/dining&cafe/d2.jpg" alt="wedding">
                    </div> -->
                    <div class="dining-card gs_reveal gs_reveal_fromLeft">
                        <img src="../assets/dining&cafe/minidining.jpg" alt="wedding">
                    </div>
                </div>


            </div>
            <div class="mini-dining-text_container  ">
            
                <p class="mini-dining-text reveal-type gs_reveal gs_reveal_fromRight" data-bg-color="#cccccc" data-fg-color="black">
                    Experience a culinary journey like no other at <span class="brand-name">LUNA</span>. Indulge in exquisite dining with globally-inspired menus crafted by our expert chefs, using locally sourced ingredients for an unforgettable taste sensation.  Discover the perfect blend of taste and ambiance at <span class="brand-name">LUNA</span>.
                </p>
                <a href='dining.php' class='design-link mb-4'>
                    <div class='design-link-container'>
                        <div class='mask'>
                            <span class='link-design design_link1'>Learn More</span>
                            <span class='link-design design_link2'>Learn More</span>
                        </div>
                    </div>
                        <i class='bi bi-arrow-right'></i>
                </a>
            </div>
            <div class="section-divider-blur"></div>
        </div>
    </section>
    <!--dining  end -->
    <!--gallery  start -->
    <section class="mini-gallery  mt-4">
        <h2 class="main-title text-center text-uppercase gs_reveal ">Arts</h2>
        <div class="h-line s-line"></div>
        <div class="container-fluid mini-gallery-container">
            <div class="gallery-card inset-card gs_reveal gs_reveal_fromLeft">
                <p class="mini-gallery-text reveal-type" data-bg-color="#cccccc" data-fg-color="black">Step into a world of artistic wonder at <span class="brand-name">LUNA</span>'s gallery space. Our carefully curated collection showcases the finest works of local and international artists, offering a captivating blend of styles and perspectives. From captivating paintings to striking sculptures, each piece invites you to explore, reflect, and be inspired.</p>
                <a href='gallery.php' class='design-link mb-4'>
                    <div class='design-link-container'>
                        <div class='mask'>
                            <span class='link-design design_link1'>Learn More</span>
                            <span class='link-design design_link2'>Learn More</span>
                        </div>
                    </div>
                        <i class='bi bi-arrow-right'></i>
                </a>
            </div>
        </div>
    </section>
    <!--gallery  end -->
   
    <!--news  start -->
    <section class="mini-news  mt-4 shrink" >
        <h2 class="main-title text-center text-uppercase ">announcements</h2>
        <div class="h-line s-line"></div>
        <div class="container mini-news-container" id="shrink-tagline">
            <div class="inset-card">
                <div class="first-anno">
                    <p class="first-anno-text " >Over the next few weeks, <span class="brand-name">LUNA</span> will launch <b>Packages</b> that include discounts on rooms, dining and cafe, spa, gym, and other facilities. In the upcoming updates, customers will also be able to make reservations for these packages.</p> 
                    <p class="sec-anno-text ">Additionally,<span class="brand-name"> LUNA</span> will launch a brand-new service called membership, which will come with a ton of deals, discounts, and rewards. Details on the Membership System will be provided upon its launch.</p> 
                </div>
            </div>
        </div>
    </section>
    <!--news  end -->

    
    
</main>
<!-- chatbot section start -->
<?php require('./chatbot.php');?>    
<!-- chatbot section end -->

        
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>





<!-- Password reset modal and code -->
    <div class="modal fade z-model" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recoveryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-bg">
                <form id="recovery-Form" method="POST">
                    
                    <div class="modal-header  border-0 shadow-none">
                        
                        <h3 class="modal-title col-11 text-center" ><i class="bi bi-person-fill-lock"></i>Set Up New Password</h3>
                        <button type="reset" class="btn-close col-10 " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        
                        <div class="container-fluid ">
                            <div class="row mb-0">
                                <div class="col-12 ps-0 mb-3">
                                        <label class="form-label">New Password</label>
                                        <div class="pass-container d-flex">
                                            <input type="password" name="new-pass" class="form-control shadow-none new-pass" id="new-pass" required>
                                            <input type="hidden" name="email">
                                            <input type="hidden" name="token">
                                            <div class="show-pass_container">
                                                <span class="show-pass">
                                                    <i class="bi bi-eye-slash toggle-pass" data-target="new-pass"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <span class="p-note">*Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase, and one lowercase letter.</span>
                            
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        
                        <button type="reset" class="btn" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-color2 btn-md m-2 shadow-none">Submit</button>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>      

<!-- footer -->
<?php require('files/footer.php');?>

<script src="./js/index.js"></script>

<!--Password Code  -->
<?php
    if (isset($_GET['account_recovery'])) 
    {
        $data = filtration($_GET);

    $t_date = date("Y-m-d");
    $query = select("SELECT * FROM `customer` WHERE `CustomerEmail`=? AND `Token`=? AND `T_Expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');

    if(mysqli_num_rows($query)==1){
        echo <<<showModal
            <script>

            var myModal = document.getElementById("recoveryModal");

            myModal.querySelector("input[name='email']").value = "$data[email]";
            myModal.querySelector("input[name='token']").value = "$data[token]";
            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
            </script>

        showModal;
    }else{
        alert("error", "Invalid or Expired Link!");
    }

    }
?>

<script>
    // account recovery
let recovery_form = document.getElementById("recovery-Form");
recovery_form.addEventListener("submit", function (e) {
  e.preventDefault();

  let data = new FormData();
  data.append("recovery_pass", "");
  data.append("new_pass", recovery_form.elements["new-pass"].value);
  data.append("email", recovery_form.elements["email"].value);
  data.append("token", recovery_form.elements["token"].value);

  var myModal = document.getElementById("recoveryModal");
  var modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/login_register.php", true);

  xhar.onprogress = function () {};

  xhar.onload = function () {
    if (this.responseText == "failed") {
      alert("error", "Account Password Reset Failed!");
    } else {
      alert("success", "Account Password Reset Successful!");
      recovery_form.reset();
    }
  };
  xhar.send(data);
});
</script>

</body>
</html>