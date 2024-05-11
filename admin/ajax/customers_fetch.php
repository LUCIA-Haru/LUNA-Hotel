<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();


if(isset($_POST['get_customers'])){
    $res = selectAll('customer');
    $i = 1;
    $path = CUSTOMER_IMG_PATH;
    $data = "";

    while($row = mysqli_fetch_assoc(($res))){
        $del_btn = "<button type='button' onclick='remove_customer({$row['CustomerID']})' class='btn btn-danger shadow-none btn-sm mt-1'>
                        <i class='bi bi-trash'></i>
                    </button>";
       $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i> </span>";
        if($row["Is_Verified"]){
             $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i> </span>";
            $del_btn = "";
        }
        $status = "<button onclick='customer_toggleStatus($row[CustomerID],0)' class='btn btn-success btn-sm shadow-none'>Active</button>";

        if(!$row['CustomerStatus']){
            $status = "<button onclick='customer_toggleStatus($row[CustomerID],1)' class='btn btn-secondary btn-sm shadow-none'>Inactive</button>";
        }

        $date = date("d - m - Y",strtotime($row['DateTime']));

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[ProfilePic]' width='55px'> <br>
                $row[CustomerFullName]
                </td>
                <td>$row[Gender]</td>
                <td>$row[CustomerEmail]</td>
                <td>$row[CustomerPhoneNo]</td>
                <td>$row[CustomerDOB]</td>
                <td>$row[CustomerNRC]</td>
                <td>$row[PassportNo]</td>
                <td>$row[Street]</td>
                <td>$row[Township]</td>
                <td>$row[City]</td>
                <td>$row[Country]</td>
                <td>$row[PostalCode]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}


//remove customer
if (isset($_POST["remove_customer"])) {
    $frm_data = filtration($_POST);

    
    $res = delete("DELETE FROM `customer` WHERE `CustomerID`=? AND `Is_Verified`=?", [$frm_data['CustomerID'],0], 'ii');

    if($res){
        echo 1;
    }else{
        echo 0;
    }
    
}

// // toggle
if(isset($_POST['customer_toggleStatus'])){
    $frm_data = filtration($_POST);

    $q = "UPDATE `customer` SET `CustomerStatus`= ? WHERE `CustomerID`=?";
    $v = [$frm_data['value'], $frm_data['customer_toggleStatus']];

    if(update($q,$v,'ii')){
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_POST['search_customer'])){
    $frm_data = filtration($_POST);
    $query = "SELECT * FROM `customer` WHERE `CustomerFullName` LIKE ?";
    $res = select($query,["%$frm_data[username]%"],'s');
    $i = 1;
    $path = CUSTOMER_IMG_PATH;
    $data = "";

    while($row = mysqli_fetch_assoc(($res))){
        $del_btn = "<button type='button' onclick='remove_customer({$row['CustomerID']})' class='btn btn-danger shadow-none btn-sm mt-1'>
                        <i class='bi bi-trash'></i>
                    </button>";
       $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i> </span>";
        if($row["Is_Verified"]){
             $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i> </span>";
            $del_btn = "";
        }
        $status = "<button onclick='customer_toggleStatus($row[CustomerID],0)' class='btn btn-success btn-sm shadow-none'>Active</button>";

        if(!$row['CustomerStatus']){
            $status = "<button onclick='customer_toggleStatus($row[CustomerID],1)' class='btn btn-secondary btn-sm shadow-none'>Inactive</button>";
        }

        $date = date("d - m - Y",strtotime($row['DateTime']));

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[ProfilePic]' width='55px'> <br>
                $row[CustomerFullName]
                </td>
                <td>$row[Gender]</td>
                <td>$row[CustomerEmail]</td>
                <td>$row[CustomerPhoneNo]</td>
                <td>$row[CustomerDOB]</td>
                <td>$row[CustomerNRC]</td>
                <td>$row[PassportNo]</td>
                <td>$row[Street]</td>
                <td>$row[Township]</td>
                <td>$row[City]</td>
                <td>$row[Country]</td>
                <td>$row[PostalCode]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}



?>
