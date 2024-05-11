<?php
require('./files/db_config.php');
require('./files/essentials.php');
adminLogin();

// Handle mark as seen
if(isset($_POST['action']) && isset($_POST['contact_id'])){
    $action = $_POST['action'];
    $contact_id = $_POST['contact_id'];

    if($action === 'mark_as_read'){
        $q = "UPDATE `contact` SET `Seen`=? WHERE `ContactID`=?";
        $values = [1, $contact_id];
        if (update($q, $values, 'ii')) {
            echo json_encode(['status' => 'success', 'message' => 'Marked as Read']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Operation Failed']);
            exit;
        }
    } elseif ($action === 'delete') {
        $q = "DELETE FROM `contact` WHERE `ContactID`=?";
        $values = [$contact_id];
        if (update($q, $values, 'i')) {
            echo json_encode(['status' => 'success', 'message' => 'Deleted']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Operation Failed']);
            exit;
        }
    }
}
// Handle mark all as read
if(isset($_POST['action']) && $_POST['action'] === 'mark_all_as_read'){
    $q = "UPDATE `contact` SET `Seen`=?";
    $values = [1];
    if (update($q, $values, 'i')) {
        echo json_encode(['status' => 'success', 'message' => 'Marked all as Read']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Operation Failed']);
        exit;
    }
}

// Handle delete all
if(isset($_POST['action']) && $_POST['action'] === 'delete_all'){
    $q = "DELETE FROM `contact`";
    if (mysqli_query($con, $q)) {
        echo json_encode(['status' => 'success', 'message' => 'All data are Deleted']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Operation Failed']);
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <?php require('./files/a_links.php') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require('./files/a_header.php') ?>
    <main id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 ms-auto p-4 overflow-hidden">
                    <h3 class="mb-4">Manage Queries</h3>
                    <!-- query Section Start-->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-end mb-4">
                                <button onclick="mark_all_as_read()" class="btn btn-dark rounded-pill shadow-none">
                                    <i class="bi bi-check-all"></i> Mark all read
                                </button>

                                <button onclick="deleteAll()" class="btn btn-danger rounded-pill shadow-none">
                                    <i class="bi bi-trash"></i> Delete All
                                </button>
                            </div>
                            <div class="table-responsive-md" style="height: 450px;overflow-y:scroll;">
                                <table class="table table-hover border">
                                    <thead class="sticky-top">
                                        <tr class="bg-dark text-light">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" width="20%">Subject</th>
                                            <th scope="col"width="20%">Message</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = "SELECT * FROM `contact` ORDER BY `ContactID` DESC";
                                        $data = mysqli_query($con, $q);
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($data)){
                                            $seen = '';
                                            if ($row['Seen'] != 1) {
                                                $seen = "<button onclick='markAsRead($row[ContactID])' class='btn btn-sm rounded-pill btn-primary'>Mark as Read</button></br>"; 
                                            }
                                            $seen .= "<button onclick='deleteEntry($row[ContactID])' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</button>";
                                            echo <<<query
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[UserName]</td>
                                                <td>$row[UserEmail]</td>
                                                <td>$row[Subject]</td>
                                                <td>$row[Message]</td>
                                                <td>$row[QueryDateTime]</td>
                                                <td>$seen</td>
                                            </tr>
                                            query;
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- query Section End-->
                </div>
            </div>
        </div>
    </main>
    <!-- footer -->
    <?php require('./files/a_footer.php') ?>

    <script>
       function markAsRead(contactID) {
        $.ajax({
            type: 'POST',
            url: 'queries.php',
            data: { action: 'mark_as_read', contact_id: contactID },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    alert('success', 'Mark As Read');
                    setTimeout(function() {
                        location.reload();
                    }, 1000); 
                } else {
                    alert('error','Failed');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function deleteEntry(contactID) {
        
            $.ajax({
                type: 'POST',
                url: 'queries.php',
                data: { action: 'delete', contact_id: contactID },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                         alert('error','Successfully Deleted!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000); 
                    } else {
                        alert('error','Operartion Failed');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        
    }

    function mark_all_as_read() {
    
        $.ajax({
            type: 'POST',
            url: 'queries.php',
            data: { action: 'mark_all_as_read' },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    alert('success', 'Mark As All Read');
                    setTimeout(function() {
                        location.reload();
                    }, 1000); 
                } else {
                    alert('error','Failed');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    
}


    function deleteAll() {
       
            $.ajax({
                type: 'POST',
                url: 'queries.php',
                data: { action: 'delete_all' },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        alert('error','Successfully Deleted All!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000); 
                    } else {
                        alert('error','Failed');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        
    }

    </script>
</body>
</html>
