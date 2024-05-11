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
    <?php
    require ('./files/a_header.php');
    $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

    $current_reservations = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CASE WHEN r.ReservationStatus = 'CONFIRMED' AND ci.CheckInStatus = 'Pending' THEN 1 END) AS New_Reservations,
        COUNT(CASE WHEN r.ReservationStatus = 'CANCELLED' AND p.RefundStatus IS NULL THEN 1 END) AS Refund_Reservations,
         COUNT(CASE WHEN r.ReservationStatus = 'ASSIGNED' AND ci.CheckInStatus = 'Checked In' THEN 1 END) AS CheckOut_Reservations
        FROM 
        reservation r
        INNER JOIN checkIn ci ON r.ReservationID = ci.ReservationID 
        INNER JOIN checkOut co ON r.ReservationID = co.ReservationID 
        INNER JOIN reservationdetails rd ON r.ReservationID = rd.ReservationID 
        INNER JOIN roomType ro ON ro.RTID = rd.RTID
        INNER JOIN payment p ON co.CheckOutID = p.CheckOutID;
    "));

    $current_customers = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(CustomerID) AS `total`,
        COUNT(CASE WHEN CustomerStatus = 1 THEN 1 END) AS `active`,
        COUNT(CASE WHEN CustomerStatus = 0 THEN 1 END) AS `inactive`,
        COUNT(CASE WHEN Is_Verified = 1 THEN 1 END) AS `verified`,
        COUNT(CASE WHEN Is_Verified = 0 THEN 1 END) AS `unverified`
    FROM `customer`;
        
    "));
    ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-4 text-uppercase">Dashboard</h3>
                        <?php
                        if ($is_shutdown['shutdown']) {
                            echo <<<data
                                <h6 class="bade bg-warning py-2 px-3">Shutdown Mode Is Active!</h6>

                            data;
                        }
                        ?>
                    </div>
                    <h5 class="mb-4 text-uppercase mini-title">Manage</h5>
                    <div class="row mb-4">
                        <div class="col-6 col-md-3 mb-4">
                            <a href="new_reservations.php" >
                                <div class="card text-center p-3 inset-card">
                                    <h6 class="d-card-mini-title">New Reservations</h6>
                                    <h1 class="d-card-mini-text"><?php echo $current_reservations['New_Reservations'] ?></h1>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-md-3 mb-4">
                            <a href="checkout.php" >
                                <div class="card text-center p-3 inset-card">
                                    <h6 class="d-card-mini-title">Check Out</h6>
                                    <h1 class="d-card-mini-text"><?php echo $current_reservations['CheckOut_Reservations'] ?></h1>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <a href="refund.php" >
                                <div class="card text-center p-3 inset-card">
                                    <h6 class="d-card-mini-title">Refund Reservations</h6>
                                    <h1 class="d-card-mini-text"><?php echo $current_reservations['Refund_Reservations'] ?></h1>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-6 col-md-3 mb-4">
                            <a href="new_reservations.php" >
                                <div class="card text-center p-3 inset-card">
                                    <h6 class="d-card-mini-title">User Queries</h6>
                                    <h5 class="d-card-mini-text">5</h5>
                                </div>
                            </a>
                        </div> -->
                            <!-- <div class="col-6 col-md-3 mb-4">
                                <a href="new_reservations.php" >
                                    <div class="card text-center p-3 inset-card">
                                        <h6 class="d-card-mini-title">Reviews & Ratings</h6>
                                        <h5 class="d-card-mini-text">5</h5>
                                    </div>
                                </a>
                            </div>
                        </div> -->
                        
                    </div>
                    <!-- Analysis -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="mb-4 text-uppercase mini-title">Reservation Analysis</h5>
                        <select class="form-select shadow-none container-bg w-auto" onchange="reservation_analytic(this.value)">                           
                            <option value="1">Past 30 Days</option>
                            <option value="2">Past 90 Days</option>
                            <option value="3">Past 1 Year</option>
                            <option value="3">All Time</option>
                        </select>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6 col-md-3 mb-4 ">
                            <div class="card text-center p-3 inset-card ">
                                <h6 class="d-card-mini-title text-primary">Total Reservations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-primary" id="total_reservations">0</h1>
                                <h3 class="d-card-mini-text mt-2 mb-0 text-primary" id="all_total">$ 0</h3>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-success">Active Reservations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-success" id="active_reservations">0</h1>
                                <h3 class="d-card-mini-text mt-2 mb-0 text-success" id="active_amount">$ 0</h3>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-info">Confirm Reservations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-info" id="confirm_reservations">0</h1>
                                <h3 class="d-card-mini-text mt-2 mb-0 text-info" id="confirm_amount">$ 0</h3>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title">Check Out Reservations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 " id="checkout_reservations">0</h1>
                                <h3 class="d-card-mini-text mt-2 mb-0 " id="checkout_amount">$ 0</h3>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-warning">Cancelled Reservations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-warning" id="cancelled_reservations">0</h1>
                                <h3 class="d-card-mini-text mt-2 mb-0 text-warning" id="refund_amount">$ 0</h3>
                                
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                    
                    <!-- Customers, Queries, Reviews -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="mb-4 text-uppercase mini-title">Customers, Queries, Reviews Analysis</h5>
                        <select class="form-select shadow-none container-bg w-auto" onchange="customer_analytic(this.value)">
                            
                            <option value="1">Past 30 Days</option>
                            <option value="2">Past 90 Days</option>
                            <option value="3">Past 1 Year</option>
                            <option value="3">All Time</option>
                        </select>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title">New Registrations</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0" id="newreg">0</h1>
                                
                                
                            </div>
                            
                        </div>
                        <!-- <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title ">Queries</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0">0</h1>
                                
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title ">Reviews & Ratings</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0">0</h1>
                                
                                
                            </div>
                            
                        </div> -->
                        
                        
                        
                    </div>
                    <!-- Customers -->
                    <h5 class="customers-title">Customers</h5>
                    <div class="row mb-4">
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card ">
                                <h6 class="d-card-mini-title text-info">Total</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-info"><?php echo $current_customers['total'] ?></h1>
                                
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-success">Active</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-success"><?php echo $current_customers['active'] ?></h1>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-warning">Inactive</h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-warning"><?php echo $current_customers['inactive'] ?></h1>
                                
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card text-center p-3 inset-card">
                                <h6 class="d-card-mini-title text-danger">Unverified </h6>
                                <h1 class="d-card-mini-text mt-2 mb-0 text-danger"><?php echo $current_customers['unverified'] ?></h1>
                                
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </main>








<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/dashboard.js"></script>
</body>
</html>