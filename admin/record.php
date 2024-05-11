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
    <title>Reservation Records</title>
    <?php require('./files/a_links.php') ?>
</head>
<body>
    <?php require('./files/a_header.php') ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4 text-uppercase">Reservation Records</h3>
                        <!-- New Reservations Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                
                                    <input type="text" id="search_input" oninput="get_reservations(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                                
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover border " style="min-width: 1200px;">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top  z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Customer Details</th>
                                            <th scope="col">Room Details</th>
                                            <th scope="col">Reservations Details</th>
                                            <th scope="col">Payment Details</th>
                                            <th scope="col">Status</th>
                                            
                                           <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Reservations_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                            <!-- Pagination -->
                            <nav >
                                <ul class="pagination mt-3" id="table-pagination">
                                    
                                </ul>
                                </nav>
                        </div>
                    </div>
                    <!-- New Reservations Section End-->
                  
                    
                </div>
            </div>
        </div>
    </main>
    <!-- Assign   Modal Start -->
        <div class="modal fade" id="assign_room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="assign_room_form" method="POST" action="new_reservations.php" autocomplete="off">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Assign Room Number</h5>
                            
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <input type="hidden" name="RTID">
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Room Numbers</label>
                                    <div class="row">
                                        <div id="room_numbers_container"></div>
                                        
                                    </div>
                                </div>

                                
                                
                                 <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                                    Note: Assign Room Number only when guest has been arroved.
                                </span>
                                <input type="hidden" name="ReservationID">
                                
                                                                    
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>


                            <button type="submit" class="btn btn-secondary text-white shadow-none">Assign</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!--  Assign   Modal End -->





<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/record.js"></script>
</body>
</html>