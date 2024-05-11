<!--=============== FAVICON ===============-->
    <link
      rel="shortcut icon"
      href="../assets/img/favicon.ico"
      type="image/x-icon"
    />

    <!-- bootstrap -->
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<!-- icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- CSS -->
<link rel="stylesheet" href="../main.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/responsive.css">

<!-- <script src="../gsap/gsap-public/minified/gsap.min.js"></script>
<script src="../gsap/gsap-public/minified/ScrollTrigger.min.js"></script>
<script src="../gsap/gsap-public/minified/TextPlugin.min.js"></script> -->
<!-- lenis -->
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script> 
<?php

session_start();

require('../admin/files/db_config.php'); 
require('../admin/files/essentials.php'); 

date_default_timezone_set("Asia/Yangon");

$settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];

$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));




?>