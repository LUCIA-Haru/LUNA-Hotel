
<header class="header">
   
    <!-- MiniHeader Section Start -->
    <div class="miniheader ">
        <div class="container-fluid">
            <div class="row d-md-flex justify-content-between align-items-center">
                <div class="col-md-4 col-12 mt-lg-2 mt-md-1">
                    <div class="d-flex align-items-md-center text-start m-sm-0">
                        <div class="dropdown-center pe-1 language_dropdown">
                            <button class="btn dropdown-toggle btn-color" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Languages
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Japan</a></li>
                                <li><a class="dropdown-item" href="#">Korea</a></li>
                                <li><a class="dropdown-item" href="#">China</a></li>
                                <li><a class="dropdown-item" href="#">French</a></li>
                                <li><a class="dropdown-item" href="#">Spain</a></li>
                                <li><a class="dropdown-item" href="#">Thai</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-center currency_dropdown">
                            <button class="btn btn-color dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Currency
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">GBP</a></li>
                                <li><a class="dropdown-item" href="#">JPY</a></li>
                                <li><a class="dropdown-item" href="#">KRW</a></li>
                                <li><a class="dropdown-item" href="#">CNY</a></li>
                                <li><a class="dropdown-item" href="#">EUR</a></li>
                                <li><a class="dropdown-item" href="#">THB</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-6 text-md-center text-sm-start">
                    <div class="logo  p-2">
                        <a href="index.php"><h3>LUNA</h3></a> 
                    </div>
                </div>
                <div class="col-md-4 col-6 text-end d-flex align-items-end justify-content-end">
                <!-- login & Reg btn-->
                    <div class="login-Reg">
                        <?php
                        if (isset($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
                            $path = CUSTOMER_IMG_PATH;
                            echo <<<data
                                <div class="btn-group">
                                    <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <img src="$path$_SESSION[uPic]" style="width:25px;height:25px" class="rounded-circle profile-pic me-sm-1">
                                        $_SESSION[uName]
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a href="profile.php" class="dropdown-item" type="button">Profile</a></li>
                                        <li><a href="reservation.php" class="dropdown-item" type="button">Reservation</a></li>
                                        <li><a href="logout.php" class="dropdown-item" type="button">Logout</a></li>
                                    </ul>
                                    </div>
                            data;
                        } else{
                            echo <<<data

                                <!-- Button trigger Login modal -->
                                <button type="button" class="btn btn-color " data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login
                                </button>
                                <!-- Button trigger Reg modal -->
                                <button type="button" class="btn btn-color" data-bs-toggle="modal" data-bs-target="#regModal">
                                Register
                                </button>
                            data;
                        }
                        ?>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- MiniHeader Section End -->
    <!-- Mobile Nav Section Start -->
    <div class="mobile-nav-wrapper">
        <div class="nav-container">
            <div class="bars"></div>
        </div>
        <nav class="mobile-nav">
            <a class="nav-link logo" href="index.php"><img src="../assets/img/l.png" alt="luna"class="luna-logo"></a>
            <div class="nav-close">

                <div class="close-bar"></div>
            </div>
            <ul>
                <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rooms.php">ROOMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dining.php">RESTAURANT & CAFE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="events.php">MEETING & EVENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="facilities.php">FACILITIES</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">GALLERY</a>
                </li>

            </ul>
        </nav>
    </div>
    <!-- Mobile Nav Section End -->
    <!--  Nav Section Start -->
    <div class="large-nav-wrapper">
        <nav class="navtwo " id="nav-bar">
            <div class="container-fluid">
                    <ul class="navbar-menu d-flex justify-content-around align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rooms.php">ROOMS</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php"><img src="../assets/img/l.png" alt="luna"class="luna-logo"></a>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                SERVICES
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dining.php">RESTAURANT & CAFE</a></li>
                                <li><a class="dropdown-item" href="events.php">MEETING & EVENTS</a></li>
                                <li><a class="dropdown-item" href="facilities.php">FACILITIES</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">GALLERY</a>
                        </li>
                    </ul>
            </div>
        </nav>

    </div>
    <!--  Nav Section EnD -->

</header>
<!-- Modal Start -->
    <!-- Login -->
        <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-bg">
                    <form id="C-Login-Form" method="POST">
                        
                        <div class="modal-header  border-0 shadow-none">
                            
                            <h3 class="modal-title col-7 d-flex align-items-end justify-content-end" ><i class="bi bi-person-lines-fill fs-3 me-2"></i> LOGIN</h3>
                            <button type="reset" class="btn-close col-5" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            
                            <div class="container-fluid ">
                                <div class="row mb-0">
                                    <div class="col-12 ps-0 mb-3">
                                        <label class="form-label">Email / Mobile</label>
                                        <input type="text" name="email_mob" class="form-control shadow-none" required >
                                    </div>
                                
                                    <div class="col-12 ps-0 ">
                                        <label class="form-label">Password</label>
                                        <div class="pass-container d-flex">
                                            <input type="password" name="c-login-pass" class="form-control shadow-none c-login-pass" id="login-pass" required>
                                            <div class="show-pass_container">
                                                <span class="show-pass">
                                                    <i class="bi bi-eye-slash toggle-pass" data-target="login-pass"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn forgot-pass d-flex align-items-start m-0" data-bs-toggle="modal" data-bs-target="#forgotModal">
                                        Forgot Password?
                                    </button>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-evenly border-0 shadow-none">
                            
                            <button type="submit" class="btn btn-color2 btn-md">LOGIN</button>
                            <button type="reset" class="btn btn-md btn-reset me-3">Reset</button>
                        </div>
                        <!-- Button trigger Reg modal -->
                        <button type="button" class="btn reg-acc mb-3" data-bs-toggle="modal" data-bs-target="#regModal">
                            Don't have an account yet?
                        </button>

                    </form>
                </div>
            </div>
        </div>
    <!-- Reg Modal -->
        <div class="modal fade" id="regModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="regModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content modal-bg">
                    <form id="C-Register-Form" method="POST" enctype="multipart/form-data" autocomplete="off">
                        
                        <div class="modal-header  border-0 shadow-none">
                            
                            <h3 class="modal-title col-7 d-flex align-items-end justify-content-end" ><i class="bi bi-person-lines-fill fs-3 me-2"></i> Register</h3>
                            <button type="reset" class="btn-close col-5" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                Note: Your details must match with your ID that will be required during check-in.
                            </span>
                            <div class="container-fluid ">
                                <div class="row mb-0">
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input name="c-name" type="text" class="form-control shadow-none" required >
                                    </div>
                                    
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="c-email" type="email" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="c-ph" id="c-ph" class="form-control shadow-none"required >
                                    </div>
                                    
                                
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="c-dob" class="form-control shadow-none" placeholder="YYYY-MM-DD" id="dob" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">NRC</label>
                                        <input type="text" name="c-nrc" id="c-nrc" class="form-control shadow-none">
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Passport No.</label>
                                        <input type="text" name="c-passport" id="c-passport"class="form-control shadow-none">
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Street</label>
                                        <input type="text" name="c-street" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Township</label>
                                        <input type="text" name="c-town" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="c-city" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="c-country" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="number" name="c-postal" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mt-lg-4">
                                        <label class="form-label">Gender</label>
                                        <input name="c-gender" type="radio"class="ms-2" value="Male" required >Male
                                        <input name="c-gender" type="radio"  class="ms-2" value="Female" required >Female
                                        <input name="c-gender" class="ms-2" type="radio"  value="Other" required >Other*
                                    </div>
                                    <div class="col-md-12 ps-0 mb-3">
                                        <label class="form-label">Picture</label>
                                        <input type="file" name="c-pic" class="form-control shadow-none" accept="[.jpg,.jpeg,.png,.webp]" required>
                                    </div>
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="pass-container d-flex">
                                            <input type="password" name="c-pass" class="form-control shadow-none c-pass" id="pass" required>
                                            <div class="show-pass_container">
                                                <span class="show-pass">
                                                    <i class="bi bi-eye-slash toggle-pass" data-target="pass"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ps-0">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="pass-container d-flex">
                                            <input type="password" name="c-confirm" class="form-control shadow-none c-confirm" id="confirm" required>
                                            <div class="show-pass_container">
                                                <span class="show-pass">
                                                    <i class="bi bi-eye-slash toggle-pass" data-target="confirm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="p-note">*Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase, and one lowercase letter.</span>

                                    
                                <br>
                                <br>
                                    <div class="col-12">
                                        <input type="checkbox" class="me-2" required>Agree to<a href="t_c.php" > <span class="font-t">Terms & Conditions</span></a>  and <a href="policy.php"><span class="font-t">Privacy Policy</span> </a> of LUNA
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center border-0 shadow-none mb-3">
                            <button type="submit" id="submitBtn" class="btn btn-color2 btn-md" >Register</button>
                            <button type="reset" class="btn btn-md btn-reset me-3">Reset</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    <!-- forgot pass modal -->
     <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-bg">
                    <form id="Forgot-Form" method="POST">
                        
                        <div class="modal-header  border-0 shadow-none">
                            
                            <h3 class="modal-title col-11 text-center" ><i class="bi bi-key"></i>Forgot Password?</h3>
                            <button type="reset" class="btn-close col-10 " data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                Note: A link will be sent to your email to reset your password!
                            </span>
                            <div class="container-fluid ">
                                <div class="row mb-0">
                                    <div class="col-12 ps-0 mb-3">
                                        <label class="form-label">Email </label>
                                        <input type="email" name="forgot-email" class="form-control shadow-none" required >
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 text-end">
                            
                            <button type="reset" class="btn" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-color2 btn-md m-2 shadow-none email-link">Send Link</button>
                        </div>
                        

                    </form>
                </div>
            </div>
    </div>                   
<!-- Modal End -->     
