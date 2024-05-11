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
    <title>Dashboard</title>
    <?php require('./files/a_links.php') ?>
</head>
<body>
    <?php require('./files/a_header.php') ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4">Manage Features & Amenities</h3>
                        <!-- Feature Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Features</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-features">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top z-0 text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="features_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Feature Section End-->
                    <!-- Feature  Modal Start -->
                    <div class="modal fade" id="add-features" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="add_feature_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add Feature</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="feature_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="feature_desc" class=" form-control shadow-none" rows="4" required></textarea>
                                              
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
                    <!-- Features  Modal End -->
                    <!-- edit Feature  Modal Start -->
                    <div class="modal fade" id="edit-feature" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="edit_feature_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Feature</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="feature_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="feature_desc" class=" form-control shadow-none" rows="4" required></textarea>
                                              
                                            </div>
                                            <input type="hidden" name="features_id" id="edit_features_id" >
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
                    <!-- Features  Modal End -->
                        <!-- Amenities Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Amenities</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-amenities">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Icon</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="amenities_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Amenities Section End-->
                    <!-- Amenities  Modal Start -->
                    <div class="modal fade" id="add-amenities" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="add_amenities_form" method="POST" enctype="multipart/form-data">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add Amenities</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="amenities_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold">Picture</label>
                                                <input type="file" class="form-control shadow-none" name="amenities_icon"  rows="6" id="amenities_icon_inp" accept=".svg">
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
                    <!-- Amenities  Modal End -->
                    <!--Edit Amenities  Modal Start -->
                    <div class="modal fade" id="edit-amenities" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="edit_amenities_form" method="POST" enctype="multipart/form-data">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Amenities</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="amenities_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Picture</label>
                                                <br><img id="amenities_icon_show" src="" alt="amenities_icon" width="250px" > <br>
                                                <input type="file" class="form-control shadow-none" name="amenities_icon"  rows="6" id="amenities_icon_inp" accept=".svg">
                                            </div>
                                        </div>
                                      <input type="hidden" name="amenities_id" id="edit_amenities_id" >  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>


                                        <button type="submit" class="btn btn-secondary text-white shadow-none">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- edit amenities  Modal End -->
                    
                    
                </div>
            </div>
        </div>
    </main>








<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/f_a.js"></script>
</body>
</html>