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
                    <h3 class="mb-4">Manage Roomtypes</h3>
                        <!-- roomtype Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Roomtypes</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-roomtypes">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 600px;overflow-y:scroll;">
                                <table class="table table-hover border text-left">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top  z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Guests</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Features</th>
                                            <th scope="col">Amenities</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col" width="180rem">Price Per Night</th>
                                            
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            
                                           <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="roomtype_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- roomtype Section End-->
                    <!-- roomtype  Modal Start -->
                    <div class="modal fade" id="add-roomtypes" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form id="add_roomtype_form" method="POST" enctype="multipart/form-data" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add Roomtype</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="roomtype_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Adult(Max.)</label>
                                                <input type="number" min="1" max="10" name="adult" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Children(Max.)</label>
                                                <input type="number" name="children" max="10" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Area</label>
                                                <input type="number" name="area" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">From Floor</label>
                                                <input type="number" name="from" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">To Floor</label>
                                                <input type="number" name="to" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Quantity</label>
                                                <input type="number" name="quantity" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Price-Per-Night</label>
                                                <input type="number" min="1" name="price" class="form-control shadow-none"  required>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="desc" class=" form-control shadow-none" rows="4" required></textarea>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-bold" >Features</label>
                                                        <div class="row">
                                                            <?php
                                                            $res = selectAll('feature');
                                                            while($opt = mysqli_fetch_assoc($res)){
                                                                echo "
                                                                    <div class='col-md-3 mb-3'>
                                                                        <label>
                                                                            <input type='checkbox' name='features' value='$opt[FeatureID]' class='form-check-input shadow-none' >
                                                                            $opt[FeatureName]
                                                                        </label>   
                                                                    </div>
                                                                ";
                                                            } 
                                                            ?>
                                                        </div>
                                                 </div>
                                                
                                            </div> 
                                            <div class="col-md-12 mb-3">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-bold" >Amenities</label>
                                                        <div class="row">
                                                            <?php
                                                            $res = selectAll('amenities');
                                                            while($opt = mysqli_fetch_assoc($res)){
                                                                echo "
                                                                    <div class='col-md-3 mb-3'>
                                                                        <label>
                                                                            <input type='checkbox' name='amenities' value='$opt[AmenitiesID]' class='form-check-input shadow-none' >
                                                                            $opt[AmenitiesName]
                                                                        </label>   
                                                                    </div>
                                                                ";
                                                            } 
                                                            ?>
                                                        </div>
                                                 </div>
                                                
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
                    <!-- roomtypes  Modal End -->
                    <!-- edit roomtype  Modal Start -->
                    <div class="modal fade" id="edit-roomtype" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form id="edit_roomtype_form" method="POST" >

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Roomtype</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="roomtype_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Adult(Max.)</label>
                                                <input type="number" min="1" max="10" name="adult" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Children(Max.)</label>
                                                <input type="number" max="10" name="children" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Area</label>
                                                <input type="number" name="area" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">From Floor</label>
                                                <input type="number" name="from" class="form-control shadow-none" required>F
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">To Floor </label>
                                                <input type="number" name="to" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Quantity</label>
                                                <input type="number" name="quantity" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Price-Per-Night</label>
                                                <input type="number" min="1" name="price" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Description</label>
                                                <br>
                                                <textarea name="desc" class="form-control shadow-none" rows="4" required></textarea>
                                            </div>
                                           
                                            <div class="col-md-12 mb-3">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-bold" >Features</label>
                                                        <div class="row">
                                                            <?php
                                                            $res = selectAll('feature');
                                                            while($opt = mysqli_fetch_assoc($res)){
                                                                echo "
                                                                    <div class='col-md-3 mb-3'>
                                                                        <label>
                                                                            <input type='checkbox' name='features' value='$opt[FeatureID]' class='form-check-input shadow-none' >
                                                                            $opt[FeatureName]
                                                                        </label>   
                                                                    </div>
                                                                ";
                                                            } 
                                                            ?>
                                                        </div>
                                                 </div>
                                                
                                            </div> 
                                            <div class="col-md-12 mb-3">
                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-bold" >Amenities</label>
                                                        <div class="row">
                                                            <?php
                                                            $res = selectAll('amenities');
                                                            while($opt = mysqli_fetch_assoc($res)){
                                                                echo "
                                                                    <div class='col-md-3 mb-3'>
                                                                        <label>
                                                                            <input type='checkbox' name='amenities' value='$opt[AmenitiesID]' class='form-check-input shadow-none' >
                                                                            $opt[AmenitiesName]
                                                                        </label>   
                                                                    </div>
                                                                ";
                                                            } 
                                                            ?>
                                                        </div>
                                                 </div>
                                                
                                            </div> 

                                            
                                             <input type="hidden" name="RTID" id="RTID">                                
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
                    <!-- edit roomtypes  Modal End -->
                    <!-- Room Images  Modal Start -->
                    <div class="modal fade" id="rt-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">RoomType Name</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="image-alert"></div>
                                    <div class="border-bottom border-3 pb-3 mb-3">
                                        <form id="add_image_form">
                                            <label class="form-label fw-bold">Add Image</label>
                                                <input type="file" class="form-control shadow-none" name="rtImg"  rows="6" id="rtImg" accept="image/jpeg, image/png, image/webp" required>
                                                <button class="btn btn-secondary text-white shadow-none m-2">ADD</button>
                                                <input type="hidden" name="RTID">
                                        </form>
                                    </div>
                                    <div class="table-responsive-lg" style="height: 350px;overflow-y:scroll;">
                                            <table class="table table-hover border text-center">
                                                <thead>
                                                    <tr class="bg-dark text-light sticky-top">
                                                        <th scope="col" width="60%">Image</th>
                                                        <th scope="col">Active</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="rt-image-data">
                                                    
                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--Manage rooms images  Modal End -->
                    
                </div>
            </div>
        </div>
    </main>






<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/rt.js"></script>
</body>
</html>