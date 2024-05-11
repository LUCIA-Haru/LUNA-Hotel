<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNA</title>
    <?php require('./files/links.php') ?>
    <link href="
https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css
" rel="stylesheet">
</head>
<body>
<!-- Header links -->
<?php require('files/header.php');?>

<!-- Main section start -->
<main class="c_main">
    <div class="gallery-bg-color"></div>
     <!-- breadcrumb start -->
    <nav class="breadcrumb_container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-t text-uppercase"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active  font-t text-uppercase" aria-current="page">gallery</li>
        </ol>
    </nav>

    <!-- breadcrumb end -->
    <!-- gallery start -->
    <div class="gallery-banner_container">
        <div class="smooth-scroller">
            <div class="hero-scroller">
                <div class="gallery-section">
                    <div class="gallery-section-wrapper">
                        <div class="gallery-content">
                            <h1 class="hero-header h-1 text-uppercase">
                                Art
                            </h1>
                            <h1 class="hero-header h-2 text-uppercase">
                                in
                            </h1>
                            <h1 class="hero-header h-3 text-uppercase">
                                gallery
                            </h1>
                        </div>
                        <div class="pin-wrapper">
                            <div class="gallery-img-wrapper heroImage" id="heroImage">
                                <img src="../assets/gallery/banner.jpg" alt="art" class="gallery-hero-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="gallery" id="gallery">
        <div class="counter">
            <p>0</p>
        </div>
        <

        <div class="gallery-items">
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g1.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g2.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g3.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g4.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g5.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g6.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g7.jpg" alt="art">
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-item-img">
                    <img src="../assets/gallery/g8.jpg" alt="art">
                </div>
            </div>
            
        </div>
    </div>
    <!-- gallery end -->


    
    
</main>
<?php require('./chatbot.php');?>    
        
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>
      

<!-- footer -->

<?php require('files/footer.php');?>
<script src="./js/gallery.js"></script>



</body>
</html>