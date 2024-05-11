<!-- cookies start -->
<div class="cookie_wrapper">
  <div class="cookie_header">
    <i class="bi bi-cookie"></i>
  <h3 class="mini-title">Cookies Constent</h3>
  </div>
  <div class="cookies-content">
    <p class="cookies_text">
      We use cookies to enhance your experience on our hotel website. By clicking "Accept", you consent to the use of cookies for analyzing site traffic and customizing your stay. For more details, please view our <a href="policy.php" class="me-4 font-t"> Cookie Policy</a>.
    </p>
    <div class="cookies_btn">
      <button class="custom-btn cookiebtn" id="acceptBtn">I understand</button>
    </div>
  </div>
</div>
<!-- cookies end -->



<footer>
  <div class="container-fluid footer-container fade-in">
    <div class="row footer_info">
      <div class="logo_container col-2 col-sm-2 d-flex align-items-center">

        <img src="../assets/img/l.png" class="luna-logo" alt="logo">
      </div>
      <div class="about_f_container col-5 ">
        <h4 class="mt-1 text-uppercase">About <span class="brand-name">LUNA</span> </h4>
          <ul class="f_menu">
            <li class="f_item text-uppercase"><a href="about.php">About Us</a></li>
            <li class="f_item text-uppercase"><a href="gallery.php ">Gallery</a></li>
            <li class="f_item text-uppercase"><a href="events.php ">events</a></li>
            <li class="f_item text-uppercase"><a href="about.php#location">Site Map</a></li>
            <li class="f_item text-uppercase"><a href="contact.php">contact us</a></li>
            <li class="f_item text-uppercase"><a href="contact.php#reviews">Reviews</a></li>
          </ul>
      </div>
      <div class="contact_f_container col-5 ">
        <h4 class="mt-1 text-uppercase">support</h4>
          <ul class="c_menu">
            <li><b class="text-uppercase">Email:</b> luna1majestic@gmail.com</li>
            <li><b class="text-uppercase">Phone:</b> (+95)0936852177</li>
            <li><b class="text-uppercase">Address:</b> 72 - LOON ROAD, KALAW , Myanmar</li>
          </ul>
      </div>
    </div>
    <div class="row">
      <div class="social_container col-12 d-flex align-items-center justify-content-center">
        <a href="https://www.facebook.com/"><i class="bi bi-facebook me-3"></i></a>
        <a href="https://www.twitter.com/"><i class="bi bi-twitter-x me-3"></i></a>
        <a href="https://www.instagram.com/"><i class="bi bi-instagram me-3"></i></a>
        <a href="https://www.whatsapp.com/"><i class="bi bi-whatsapp me-3"></i></a>
      </div>
    </div>
    <div class="row copyright_container d-flex justify-content-between align-items-center ">
      
        <div class="col-6 col-sm-6">
          <p class="m-1">&copy;2024 <span class="brand-name">LUNA</span>.All Rights Reserved.</p>
        </div>
        <div class="privacy_container col-6 col-sm-6 d-flex justify-content-end">
          <a href="policy.php" class="me-4"> Privacy Policy</a>
        <a href="t_c.php">Terms & Conditions</a>
        </div>
     
    </div>
  </div>
</footer>
<!-- shutdown -->
<?php
if ($settings_r['shutdown']) {
    echo <<<alertbar
            <div class=" text-center p-2 fw-bold shutdown"><i class="bi bi-exclamation-triangle-fill"></i>
            Bookings are temporarily  closed due to website maintenance.<br>Please try again later!
            </div>
    alertbar;
    } 
?>

<!-- Bootstrap -->
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- GSAP -->
<script src="../gsap/gsap-public/minified/gsap.min.js"></script>
<script src="../gsap/gsap-public/minified/ScrollTrigger.min.js"></script>

<!-- lenis -->
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script> 
<!-- <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script> -->


<!-- JS -->
<script src="./js/main.js"></script>
<script src="./js/register_login.js"></script>


<script>
  function checkLoginToBook(status, RT_ID) {
    if (status) {
    window.location.href = "reservation_details.php?id=" + RT_ID;
  } else {
    alert("error", "Please login to make a reservation!");
  }
}

</script>