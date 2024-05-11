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
                    <h3 class="mb-4">Manage Customers</h3>
                        <!-- Customers Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                
                                    <input type="text" oninput="search_customer(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                                
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover border text-left">
                                    <thead>
                                        <tr class="bg-dark text-light sticky-top  z-0">
                                            <th scope="col">#</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">PhoneNo</th>
                                            <th scope="col">DOB</th>
                                            <th scope="col">NRC</th>
                                            <th scope="col">PassportNo</th>
                                            <th scope="col" >Street</th>
                                            <th scope="col">Township</th>
                                            
                                            <th scope="col">City</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Postal Code</th>
                                            <th scope="col">Verified</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            
                                           <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Customers_data">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Customers Section End-->
                  
                    
                </div>
            </div>
        </div>
    </main>






<!-- footer -->
    <?php require('./files/a_footer.php') ?>
    <script src="./js/customers.js"></script>
</body>
</html>