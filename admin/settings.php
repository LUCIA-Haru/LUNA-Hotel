<?php
require('./files/db_config.php');
require('./files/essentials.php');
adminLogin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php require('./files/a_links.php') ?>
</head>
<body>
    <?php require('./files/a_header.php') ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4">SETTINGS</h3>

                    <section class="section-container section-f-color">
                        <!-- General Settings Section -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h5 class="card-title m-0">General</h5>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                    <i class="bi bi-pencil-square"></i> Edit
                                    </button>


                                </div>
                                
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-1 fw-bold">Title</h6>
                                            <p class="card-text" id="site_title"></p>
                                            <h6 class="card-subtitle mb-1 fw-bold">Mission</h6>
                                            <p class="card-text" id="mission"></p>
                                            <h6 class="card-subtitle mb-1 fw-bold">Vision</h6>
                                            <p class="card-text" id="vision"></p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="card-subtitle mb-1 fw-bold">Origin of LUNA</h6>
                                            <p class="card-text" id="origin"></p>
                                            <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                                            <p class="card-text" id="site_about"></p>
                                                    </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
                    <!-- General Section Modal Start -->
                    <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="general_s_form" method="POST">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >General</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Title</label>
                                            <input type="text" name="site_title" class="form-control shadow-none" id="site_title_inp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Mission</label>
                                            <input type="text" name="mission" class="form-control shadow-none" id="mission_inp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Vision</label>
                                            <input type="text" name="vision" class="form-control shadow-none" id="vision_inp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Origin of LUNA</label>
                                            <input type="text" name="origin" class="form-control shadow-none" id="origin_inp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">About us</label>
                                            <textarea class="form-control shadow-none" name="site_about"  rows="6" id="site_about_inp" required></textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="handleCancelClick(event)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>


                                        <button type="submit" class="btn btn-secondary text-white shadow-none">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- General Section Modal End -->
                    <!-- Shutdown Section Start -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Shutdown Function</h5>
                                <div class="form-check form-switch">
                                    <form>
                                        <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                    </form>
                                </div>
                            </div>
                            <p class="card-text">
                                No customers will be allowed to book hotel room, when shutdown mode is on.
                            </p>
                        </div>
                    </div>
                    <!-- Shutdown Section End -->
                    <!-- Position Section Start -->
                    <div class="card border-0 shadow-sm mb-4">
                        
                        <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Positions</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-position">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top z-0">
                                            <th scope="col">#</th>
                                            
                                            <th scope="col">PositionName</th>
                                            <th scope="col">PositionDepartment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="position_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Position Section End -->
                     <!-- position Modal Start -->
                    <div class="modal fade" id="add-position" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="add_position_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add Position</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">PositionName</label>
                                                <input type="text" name="position_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Position Department</label>
                                                <input type="text" name="position_dept" class="form-control shadow-none" required>
                                            </div>
                                           
                                            

                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>


                                        <button type="submit" class="btn btn-secondary text-white shadow-none">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- position  Modal End -->
                     <!--edit position Modal Start -->
                    <div class="modal fade" id="edit-position" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="edit_position_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Position</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">PositionName</label>
                                                <input type="text" name="position_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Position Department</label>
                                                <input type="text" name="position_dept" class="form-control shadow-none" required>
                                            </div>
                                           
                                            <input type="hidden" name="PositionNo" id="edit_position_no" >

                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>


                                        <button type="submit" class="btn btn-secondary text-white shadow-none">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--edit position  Modal End -->
                   
                </div>
            </div>
        </div>
    </main>






<!-- footer -->
    <?php require('./files/a_footer.php') ?>
<!-- script -->
<script src="./js/settings.js"></script>
</body>
</html>