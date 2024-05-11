<?php
// Check if the user is logged in
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    $user_position = $_SESSION['positionNo'];
    $query = "SELECT * FROM `position` WHERE `PositionNo` = ?";
    $values = [$user_position];

    $res = select($query, $values, 'i');

      $row = mysqli_fetch_assoc($res);
    $positionName = $row['PositionName'];
}
?>

<!-- Sidebar Start-->
         <aside class="sbar">
            <div class="logo">
                <div class="logo"><img src="../assets/img/l.png" alt="luna" class="luna-logo"></div>
            </div>
            <div class="adminlinks" id="a_navbar">
                <ul class="links align-item-center">
                    <li class="adminlink d-flex align-items-center ">
                        <i class="bi bi-columns-gap"></i><a href="dashboard.php" class="link"> Dashboard</a>
                    </li>
                    <li class="d-flex flex-column ">
                        <i class="bi bi-calendar-check"></i><button class="btn  px-3 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#reservation_links">
                            <span class="bi-re">Reservation<i class="bi bi-caret-down-fill"></i> </span>                          
                        </button>
                        <div class="collapse px-3 small mb-1" id="reservation_links">
                            <ul class="nav nav-pills flex-column rounded ">
                                <li class="nav-item adminlink d-flex align-items-center ">
                                    <a href="new_reservations.php" class="link">New Reservations</a>
                                </li>
                                <li class="nav-item adminlink d-flex align-items-center ">
                                    <a href="refund.php" class="link">Refund Payment</a>
                                </li>
                                <li class="nav-item adminlink d-flex align-items-center ">
                                    <a href="record.php" class="link">Reservations Records</a>
                                </li>
                                <li class="nav-item adminlink d-flex align-items-center ">
                                    <a href="checkout.php" class="link">Check Out</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    
                    <?php if ($positionName !== "Receptionist"): ?>
                        <li class="adminlink d-flex align-items-center ">
                        <i class="bi bi-person-badge"></i><a href="customers.php" class="link"> Customers</a>
                        </li>
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-envelope-check"></i><a href="queries.php" class="link"> Queries</a>
                        </li>
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-star-half"></i><a href="reviews.php" class="link"> Reviews</a>
                        </li>
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-house"></i><a href="rooms.php" class="link"> Rooms</a>
                        </li>
                        <li class="adminlink d-flex align-items-center "> 
                            <i class="bi bi-building"></i><a href="roomtype.php" class="link"> Room Types</a>
                        </li>
                        
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-wifi"></i><a href="featureAmenties.php" class="link"> Features & Amenities</a>
                        </li>
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-people"></i><a href="team.php" class="link"> Team</a>
                        </li>
                        <li class="adminlink d-flex align-items-center ">
                            <i class="bi bi-gear"></i><a href="settings.php" class="link"> Settings</a>
                        </li>
                    <?php endif; ?>
                    
                </ul>
                
            </div>
            
            <div class="logout">
               <i class="bi bi-box-arrow-left"></i>
                <a href="a_logout.php">Logout</a>
            </div>
        </aside>
    

        
    <!-- Sidebar end-->