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
                    <h3 class="mb-4">Manage Rooms</h3>
                        <!-- room Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title m-0">Rooms</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-rooms">
                                <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                            
                            <div class="table-responsive-sm" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border text-center">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">RoomNo</th>
                                            <th scope="col">FloorNo</th>
                                            <th scope="col">RoomTypes</th>
                                            <th scope="col" >Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rooms_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- room Section End-->
                    <!-- room  Modal Start -->
                    <div class="modal fade" id="add-rooms" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="add_room_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Add room</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">RoomNo</label>
                                                <input type="text" name="room_no" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">FloorNo</label>
                                                <input type="number" name="floor_no" class="form-control shadow-none" required>
                                            </div>
                                           
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">RoomTypes</label>
                                                <select name="rt" class="form-select shadow-none" required>
                                                    <option value="" selected disabled>Select RoomTypes</option>
                                                    <?php
                                                        $res = selectAll('roomtype');
                                                        while ($opt = mysqli_fetch_assoc($res)) {
                                                            echo "<option value='{$opt['RTID']}'>{$opt['RTName']}</option>";
                                                        }
                                                    ?>
                                                </select>
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
                    <!-- rooms  Modal End -->
                    <!-- edit room  Modal Start -->
                    <div class="modal fade" id="edit-rooms" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="edit_room_form" method="POST" autocomplete="off">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" >Edit Rooms</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">RoomNo</label>
                                                <input type="text" name="room_no" class="form-control shadow-none" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">FloorNo</label>
                                                <input type="number" name="floor_no" class="form-control shadow-none" required>
                                            </div>
                                           
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">RoomTypes</label>
                                                <select name="rt_name" class="form-select shadow-none">
                                                    <option value="" name="rt_name" selected disabled>Select RoomTypes</option>
                                                    <?php
                                                        $res = selectAll('roomtype');
                                                        while ($opt = mysqli_fetch_assoc($res)) {
                                                            echo "<option value='{$opt['RTID']}'>{$opt['RTName']}</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                                <input type="hidden" name="edit_rooms_id" id="edit_rooms_id" >
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
                    <!-- edit rooms  Modal End -->
                   
                    
                </div>
            </div>
        </div>
    </main>








<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/rooms.js"></script>
</body>
</html>