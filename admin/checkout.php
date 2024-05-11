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
                    <h3 class="mb-4 text-uppercase">Check Out</h3>
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
                                            <th scope="col">Check-In Time</th>
                                            
                                            
                                            
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
    <script>
        function get_reservations(search = "") {
        let xhar = new XMLHttpRequest();
        xhar.open("POST", "ajax/checkout_fetch.php", true);
        xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhar.onload = function () {
            document.getElementById("Reservations_data").innerHTML = this.responseText;
        };
        xhar.send("get_reservations&search=" + search);
        }
        function checkout_room(id) {
        if (confirm("Checkout This Room?")) {
            let data = new FormData();
            data.append("ReservationID", id);
            data.append("checkout_room", "");
            let xhar = new XMLHttpRequest();
            xhar.open("POST", "ajax/checkout_fetch.php", true);
            xhar.onload = function () {
            if (this.responseText == 1) {
                alert("success", "Room is Checked Out!");
                get_reservations();
            } else {
                alert("error", "Failed to Checked Out!");
            }
            };
            xhar.send(data);
        }
        }
        document.addEventListener("DOMContentLoaded", function () {
        get_reservations();
        });
    </script>
</body>
</html>
