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
                    <h3 class="mb-4">Manage Staff</h3>
                        <!-- staff Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Staffs</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-staffs">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">NRC</th>
                                            <th scope="col">DOB</th>
                                            <th scope="col">PhNO</th>
                                            <th scope="col">Street</th>
                                            <th scope="col">Township</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Email</th>
                                            
                                            <th scope="col">Pic</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="staffs_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- staff Section End-->
                    <!-- staff  Modal Start -->
                    <div class="modal fade" id="add-staffs" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form id="add_staff_form" method="POST" enctype="multipart/form-data" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add staff</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="staff_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">NRC</label>
                                                <input type="text" name="NRC" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">DOB</label>
                                                <input type="date" name="dob" class="form-control shadow-none" placeholder="YYYY-MM-DD" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">PhoneNo</label>
                                                <input type="text" name="phone" class="form-control shadow-none staff_ph" id="staff_ph" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Street</label>
                                                <input type="text" min="1" name="street" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Township</label>
                                                <input type="text" name="township" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">City</label>
                                                <input type="text" name="city" class="form-control shadow-none"  required>
                                            </div>
                                            <!-- <div class="col-md-12 mb-3">
                                                <label class="form-label fw-bold">Position</label>
                                                <?php
                                                    $res = selectAll('position');
                                                        while ($opt = mysqli_fetch_assoc($res)) {
                                                            echo "
                                                                <div class='col-md-12 mb-3 '>

                                                                    <label class='form-check'>
                                                                        <input type='checkbox' name='position' value='{$opt['PositionNo']}' class='form-check-input shadow-none'>
                                                                        {$opt['PositionName']}
                                                                    </label>
                                                                </div>
                                                            ";
                                                        }
                                                 ?>

                                            </div> -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Position</label>
                                                <select name="position" class="form-select shadow-none">
                                                    <option value="" selected disabled>Select Position</option>
                                                    <?php
                                                        $res = selectAll('position');
                                                        while ($opt = mysqli_fetch_assoc($res)) {
                                                            echo "<option value='{$opt['PositionNo']}'>{$opt['PositionName']}</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email" name="email" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Password</label>
                                                <div class="pass-container d-flex">
                                                    <input type="password" name="staff-pass" class="form-control shadow-none staff-pass" id="staff-pass" required>
                                                    <div class="show-pass_container">
                                                        <span class="show-pass">
                                                            <i class="bi bi-eye-slash toggle-pass" data-target="staff-pass"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="pass-container d-flex">
                                                    <input type="password" name="staff-confirm" class="form-control shadow-none staff-confirm" id="staff-confirm" required>
                                                    <div class="show-pass_container">
                                                        <span class="show-pass">
                                                            <i class="bi bi-eye-slash toggle-pass" data-target="staff-confirm"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="p-note">*Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase, and one lowercase letter.</span>                                  <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Picture</label>
                                                <input type="file" class="form-control shadow-none" name="staff_pic"  rows="6" id="staff_pic_inp" accept="[.jpg, .png, .webp, .jpeg]">
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
                    <!-- staffs  Modal End -->
                    <!-- edit staff  Modal Start -->
                    <div class="modal fade" id="edit-staff" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form id="edit_staff_form" method="POST" enctype="multipart/form-data">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Staff Data</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Name</label>
                                                <input type="text" name="staff_name" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">NRC</label>
                                                <input type="text" name="NRC" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">DOB</label>
                                                <input type="date" name="dob" class="form-control shadow-none" placeholder="YYYY-MM-DD" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">PhoneNo</label>
                                                <input type="text" name="phone" class="form-control shadow-none staff_ph" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Street</label>
                                                <input type="text" min="1" name="street" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Township</label>
                                                <input type="text" name="township" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">City</label>
                                                <input type="text" name="city" class="form-control shadow-none"  required>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Position</label>
                                                <select name="position" class="form-select shadow-none">
                                                    <option value="" selected disabled>Select Position</option>
                                                    <?php
                                                        $res = selectAll('position');
                                                        while ($opt = mysqli_fetch_assoc($res)) {
                                                            echo "<option value='{$opt['PositionNo']}'>{$opt['PositionName']}</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <input type="email" name="email" class="form-control shadow-none"  required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Password</label>
                                                <div class="pass-container d-flex">
                                                    <input type="password" name="staff-edit-pass" class="form-control shadow-none staff-edit-pass " id="staff-edit-pass" required>
                                                    <div class="show-pass_container">
                                                        <span class="show-pass">
                                                            <i class="bi bi-eye-slash toggle-pass" data-target="staff-edit-pass"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="pass-container d-flex">
                                                    <input type="password" name="staff-edit-confirm" class="form-control shadow-none staff-edit-confirm" id="staff-edit-confirm" required>
                                                    <div class="show-pass_container">
                                                        <span class="show-pass">
                                                            <i class="bi bi-eye-slash toggle-pass" data-target="staff-edit-confirm"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="p-note">*Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase, and one lowercase letter.</span>
                                            
                                                
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Picture</label>
                                                <br><img id="staff_pic" src=""  alt="staff" width="250px" > <br>
                                                <input type="file" class="form-control shadow-none mt-3 " name="staff_pic"  rows="6" id="staff_pic_inp" accept="[.jpg, .png, .webp, .jpeg]">
                                            </div>
                                            <input type="hidden" name="StaffID" id="edit_staff_id" >

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
                    <!-- edit staffs  Modal End -->
                    
                </div>
            </div>
        </div>
    </main>






<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/team.js"></script>
</body>
</html>