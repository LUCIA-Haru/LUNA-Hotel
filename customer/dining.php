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
   
    <!-- dining start -->
    <section class="dining">
        <div class="dining-container" >
              <!-- breadcrumb start -->
                <nav class="breadcrumb_container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-t text-uppercase"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active  font-t text-uppercase" aria-current="page">restaurant & cafe</li>
                    </ol>
                </nav>

                <!-- breadcrumb end -->
            <div class="dining-banner_container all_banner_container fade-in">
                <div class="background-overlay"></div>
                <div class="dining-banner_img">
                    <img src="../assets/dining&cafe/d4.jpg" alt="dining">
                    <p class="dining-banner-text text-uppercase font-t t-bg gs_reveal gs_reveal_fromLeft">restaurant & cafe</p>
                    <div class="mouse-down">
                        <div class="mouse-down-wrap"><i class="bi bi-mouse"></i></div>
                    
                        <p>Scroll Down</p>
                    </div>
                </div>
                <div class="dining-banner-text-container display__info">
                    <p class="reveal-type" data-bg-color="#cccccc" data-fg-color="black">
                        Indulge your palate at LUNA's cafe and café, where culinary excellence meets exceptional ambiance. Our restaurant offers a sophisticated dining experience<span class="dots">...</span
                        ><span class="more">
                            , showcasing a fusion of local flavors and global inspiration, curated by our talented chefs. Meanwhile, our café provides a cozy retreat for coffee enthusiasts and pastry lovers alike, serving freshly brewed beverages and delectable treats in a relaxed setting.
                        </span>
                        <button class="readmore btn-color">Read more</button>
                    </p>
                </div>
            </div>
            <div class="section-divider mb-4">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>
            <div class="restaurant_container">
                <h2 class="main-title text-center text-uppercase gs_reveal ">restaurant</h2>
                    <div class="h-line s-line"></div>
                <div class="container-fluid">
                    <div class="row d-flex align-items-center justify-content-between mb-4 first">
                        <div class="r-text col-xs-12 col-md-6 font-t gs_reveal gs_reveal_fromLeft">
                            
                            <p>"Treat your senses at our restaurant. Experience culinary perfection in every dish, where flavor meets finesse."</p>
                        </div>
                        <div class="r-img col-xs-12 col-md-6 gs_reveal gs_reveal_fromRight">
                            <img src="../assets/dining&cafe/f5.jpg" alt="dining">
                        </div>
                    </div>
                    <h3 class="best text-center text-uppercase gs_reveal ">Best Dishes</h3>
                    <div class="row second">
                        <div class="best-dishes col-12 gs_reveal gs_reveal_bottom">
                            <img src="../assets/dining&cafe/s1.jpg" alt="dining" >
                            <img src="../assets/dining&cafe/s2.jpg" alt="dining">
                            <img src="../assets/dining&cafe/s3.jpg" alt="dining">
                            <img src="../assets/dining&cafe/s4.jpg" alt="dining">
                            <img src="../assets/dining&cafe/s5.jpg" alt="dining">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cafe_container">
                <h2 class="main-title text-center text-uppercase gs_reveal ">cafe´</h2>
                    <div class="h-line s-line"></div>
                <div class="container-fluid">
                    <div class="row first d-flex align-items-center justify-content-between">
                        <div class="c-img col-xs-12 col-md-6 gs_reveal gs_reveal_fromLeft">
                            <img src="../assets/dining&cafe/f3.jpg" alt="dining">
                        </div>
                        <div class="c-text col-xs-12 col-md-6 font-t gs_reveal gs_reveal_fromRight">
                            <p>"Discover a cozy haven at our café. Sip on handcrafted beverages and savor artisanal delights in a relaxed atmosphere."</p>
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="best text-center text-uppercase gs_reveal ">Best Sellers</h3>
                        <div class="best-dishes col-12 gs_reveal gs_reveal_bottom">
                            <img src="../assets/dining&cafe/c1.jpg" alt="dining" >
                            <img src="../assets/dining&cafe/c3.jpg" alt="dining" >
                            <img src="../assets/dining&cafe/c2.jpg" alt="dining" >
                            <img src="../assets/dining&cafe/c7.jpg" alt="dining" >
                            <img src="../assets/dining&cafe/c8.jpg" alt="dining" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dining end -->


    
    
</main>

        
<!-- Main section end -->
<!-- chatbot section start -->
<?php require('./chatbot.php');?>    
<!-- chatbot section end -->



<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>
      

<!-- footer -->
<?php require('files/footer.php');?>
<!-- <script src="./js/index.js"></script> -->



</body>
</html>