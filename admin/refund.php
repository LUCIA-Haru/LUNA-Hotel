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
    <title>Refund</title>
    <?php require('./files/a_links.php') ?>
</head>
<body>
    <?php require('./files/a_header.php') ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4 text-uppercase">Refund Reservations</h3>
                        <!-- New Reservations Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                
                                    <input type="text" oninput="get_reservations(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                                
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover border" style="min-width: 1200px;">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top  z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Customer Details</th>
                                            <th scope="col">Room Details</th>
                                            <th scope="col">Reservation Details</th>
                                            <th scope="col">Payment Details</th>
                                            <th scope="col">Refund Details</th>
                                            
                                            
                                           <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Reservations_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- New Reservations Section End-->
                  
                    
                </div>
            </div>
        </div>
    </main>






<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/refund.js"></script>
</body>
</html>