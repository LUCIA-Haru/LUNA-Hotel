<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNA</title>
    <?php require('./files/links.php') ?>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
</head>
<body>
<!-- Header links -->
<?php require('files/header.php');?>

<!-- Main section start -->
<main class="c_main">
    <!-- breadcrumb start -->
    <nav class="breadcrumb_container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-t text-uppercase"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active  font-t text-uppercase" aria-current="page">Contact Us</li>
        </ol>
    </nav>

    <!-- breadcrumb end -->
   <section class="contact section" id="contact">
        <h2 class="text-center gs_reveal">Contact US</h2>
        <div class="h-line s-line"></div>
        <div class="contact__container container-fluid">
            
            <div class="row p-4">
                <div class="contact__content contact-info col-xs-12 col-md-6 gs_reveal gs_reveal_fromLeft">
                    <div class="contact__info">
                    <div class="contact__data">
                        <span class="contact__data-title">Email</span>
                        <span class="contact__data-info">luna1majestic@gmail.com</span>
                    </div>

                    <div class="contact__data">
                        <span class="contact__data-title">Phone</span>
                        <span class="contact__data-info">(+95)0936852177</span>
                        
                    </div>

                    <div class="contact__data">
                        <span class="contact__data-title">Address</span>
                        <span class="contact__data-info">
                            <iframe class="w-100 rounded mb-3 mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29872.408104243405!2d96.54199338743453!3d20.626777393932997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ceb7996093ec95%3A0xf17bab75fc64bbb8!2sKalaw!5e0!3m2!1sen!2smm!4v1711479295768!5m2!1sen!2smm"></iframe>
                        </span>
                        
                        
                    </div>
                    
                    </div>
                </div>
                
                <div class="contact__content g-i-t col-xs-12 col-md-6 mt-4 gs_reveal gs_reveal_fromRight">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="contact_queries" method="POST" class="contact__form" id="contact-form">
                    <h3 class="main-title">Get in touch</h3>
                    <div class="contact__form-div">
                      <label class="contact__form-tag">Names</label>
                      <input type="text" class="contact__form-input" name="user_name" id="contact-name" required placeholder="Write your name">
                    </div>
                    <div class="contact__form-div">
                      <label class="contact__form-tag">Mail</label>
                      <input type="email" class="contact__form-input" name="user_email" id="contact-email" required placeholder="Write your email">
                    </div>
                    <div class="contact__form-div">
                      <label class="contact__form-tag">Subject</label>
                      <input type="text" class="contact__form-input" name="user_subject" id="contact-subject" required placeholder="Write your Subject">
                    </div>
                    <div class="contact__form-div contact__form-area">
                      <label class="contact__form-tag">Message</label>
                      <textarea name="user_msg" id="contact-msg" class="contact__form-input" placeholder="Write your msg"></textarea>
                    </div>
                    <p class="contact__message" id="contact-message"></p>
                    <button type="submit" name="msg_send" class="contact__button">Send<i class="bi bi-arrow-right"></i></button>
                  </form>
                </div>
            </div>
          
        </div>
      </section>
       <!-- Testimonial with Swiper Start-->
        <section class="mini-testimonial mt-4" id="reviews">
            <h2 class="main-title text-center text-uppercase gs_reveal">TESTIMONIALS</h2>
            <div class="h-line s-line"></div>
            <div class="container-fluid mini-test-container">
                <!-- Swiper -->
            <div class="swiper swiper-testimonial">
                <div class="swiper-wrapper mb-5">
                <?php
                $review_q = "SELECT r.*, c.CustomerFullName,c.ProfilePic, t.RTName,  re.ReservationNo FROM `reviews` AS r 
                    INNER JOIN `customer` AS c ON c.`CustomerID` = r.`CustomerID`
                    INNER JOIN `roomtype` AS t ON t.`RTID` = r.`RTID`
                    INNER JOIN `reservation` AS re ON re.`ReservationID` = r.`ReservationID`
                    ORDER BY r.`ReviewsID` DESC LIMIT 6";
                    
                    $review_res = mysqli_query($con, $review_q);
                    $img_path = CUSTOMER_IMG_PATH;

                    if(mysqli_num_rows($review_res)==0){
                    echo '<h3 class="text-center">No Reviews Yet!</h3>';
                    }else{
                        while($row = mysqli_fetch_assoc($review_res)){
                            $stars = "";
                            for ($i=1; $i < $row['Rating'] ; $i++) {
                                $stars .= " <i class='bi bi-star-fill text-warning'></i>";
                            }
                            echo<<<slides
                                 <div class="swiper-slide p-4 inset-card">
                                    <div class="test_profile d-flex align-items-center p-4">
                                        <img src="$img_path$row[ProfilePic]" class="rounded-circle" width="30px" height="30px">
                                        <h6 class="m-0 ms-2"> $row[CustomerFullName]</h6>
                                    </div>
                                    <p>$row[Reviews]</p>
                                    <div class="rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                            $stars
                                    </div>
                                </div>
                            slides;
                        }
                    }
                ?>
               
               
                
                
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper JS -->
            </div>
        </section>
        <!-- Testimonial with Swiper End-->


    
    
</main>
 <?php

  if (isset($_POST['msg_send'])) {
      $frm_data =filtration($_POST);

      $q = "INSERT INTO `contact`( `UserName`, `UserEmail`, `Subject`, `Message`) VALUES (?,?,?,?)";
      $values = [$frm_data['user_name'], $frm_data['user_email'], $frm_data['user_subject'], $frm_data['user_msg']];

      $res = insert($q, $values, 'ssss');
      if ($res === 1) {
        alert('success',"Your message has been sent successfully");

        
      } else {
          alert('error', 'Failed To Send!');
      }
  }
  ?>


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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  // swiper
function initSwiperTestimonial() {
  var swiper = new Swiper(".swiper-testimonial", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    slidesPerView: "2",
    loop: true,
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },

      1024: {
        slidesPerView: 4,
      },
    },
  });
}
document.addEventListener("DOMContentLoaded", () => {

  initSwiperTestimonial();

});
</script>



</body>
</html>