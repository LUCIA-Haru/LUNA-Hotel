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
 
    <!-- about start -->
    <?php
        $contact_res = selectALl("settings");
        $row = mysqli_fetch_assoc($contact_res)
        
    ?>
    <section class="about">
        <div class="about-container " >
             <!-- breadcrumb start -->
                <nav class="breadcrumb_container" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-t text-uppercase"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active  font-t text-uppercase" aria-current="page">about</li>
                    </ol>
                </nav>

            <!-- breadcrumb end -->
            
            <div class="about-banner_container all_banner_container fade-in">
                <div class="background-overlay"></div>
                <div class="about-banner_img">
                    <img src="../assets/img/about.jpg" alt="about">
                    <p class="about-banner-text text-uppercase font-t t-bg fade-in">Story</p>
                    <div class="mouse-down">
                        <div class="mouse-down-wrap"><i class="bi bi-mouse"></i></div>
                    
                        <p>Scroll Down</p>
                    </div>
                </div>
                <div class="about-banner-text-container">
                    <p class="reveal-type" data-bg-color="#cccccc" data-fg-color="black"><?php echo $row['about'] ?></p>
                </div>
            </div>
            <div class="section-divider">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>

            <div class="core-container font-t grow">
                <div class="section-divider-blur">

                    <div class="mission text-center">
                        <h2 class="main-title text-center text-uppercase">Mission</h2>
                        <div class="h-line s-line"></div>
                        <p class="m-text "><?php echo $row['Mission'] ?></p>
                    </div>
                    <div class="vision text-center">
                        <h2 class="main-title text-center text-uppercase">Vision</h2>
                        <div class="h-line s-line"></div>
                        <p class="m-text"><?php echo $row['Vision'] ?></p>
                    </div>
                    <div class="core ">
                        <h2 class="main-title text-center text-uppercase">core values</h2>
                        <div class="h-line s-line"></div>
                        <div class="container-fluid">
                            <div class="core-cards">
                                <div class="row d-flex justify-content-around align-item-center">
                                    <div class="core-card col-5 col-md-2 inset-card text-uppercase">
                                    Share to inspire
                                    </div>
                                    <div class="core-card col-5 col-md-2  inset-card text-uppercase">
                                        excellence
                                    </div>
                                    <div class="core-card col-5 col-md-2  inset-card text-uppercase">
                                        innovation
                                    </div>
                                    <div class="core-card inset-card text-uppercase col-5 col-md-2">
                                        community
                                    </div>
                                    <div class="core-card inset-card text-uppercase col-5 col-md-2">
                                        Respect to sustain
                                    </div>
                                </div>
                                
                            </div>
    
                        </div>
                    </div>
                </div>

            </div>
            <div class="section-divider mt-4 mb-4">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>
            <div class="origin fade-in">
                <h2 class="main-title text-center text-uppercase">Origin</h2>
                <div class="container">
                    <div class="row">
                        <div class="o_img col-md-6 gs_reveal gs_reveal_fromLeft">
                            <img src="../assets/img/M-VintageVine_600x.webp" alt="Majestic" >
                        </div>
                        <div class="ori_container text-center col-md-6">
                        <p class="o-text font-t reveal-type gs_reveal gs_reveal_fromRight" data-bg-color="#cccccc" data-fg-color="black"><?php echo $row['Origin'] ?></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="section-divider">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>
            <div class="social shrink">
                <div class="section-divider-blur">
                    <div class="social_container text-center">
                        <h2 class="main-title text-center text-uppercase ">community & environment</h2>
                        
                        <div class="s_card">
                            <p class="s_text reveal-type" data-bg-color="#cccccc" data-fg-color="black">Working in some of the most esteemed and immaculate locations in the world is a privilege for us, <span class="brand-name">LUNA</span>.
    We are privileged to collaborate with numerous local authorities and indigenous communities in the areas where we operate as we journey into uncharted territory. Our focus is on generating long-term value for the community at large, in addition to bringing about economic prospects.
    We have five main areas of focus for our sustainability and CSR initiatives: sustainable supply chain, health and safety, environment and biodiversity, and employee development.
    
                        </p>
                        </div>
                        
                    </div>

                </div>
            </div>
            <div class="section-divider mb-4">
                <hr class="s_d_line"><i class="bi bi-x-diamond-fill"></i><hr class="s_d_line">
            </div>
            <div class="location" id="location">
                <h2 class="main-title text-center text-uppercase mb-4">location</h2>
                
                <iframe class="w-100 rounded mb-3 mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29872.408104243405!2d96.54199338743453!3d20.626777393932997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ceb7996093ec95%3A0xf17bab75fc64bbb8!2sKalaw!5e0!3m2!1sen!2smm!4v1711479295768!5m2!1sen!2smm"></iframe>
            </div>
           
        </div>
    </section>
    <!-- about end -->


    
    
</main>

   <?php require('./chatbot.php');?>         
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>
      

<!-- footer -->
<?php require('files/footer.php');?>
<!-- <script src="./js/index.js"></script> -->



</body>
</html>