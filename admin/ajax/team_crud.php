<?php 
require('../files/essentials.php');
require('../files/db_config.php');
date_default_timezone_set("Asia/Yangon"); 
adminLogin();

// add Staff

if (isset($_POST['add_staff'])) {


    $frm_data = filtration($_POST);

     // match password and confirm password
    if($frm_data['StaffPassword'] != $frm_data['StaffConfirm']){
        echo 'pass_mismatch';
        exit;
    }
    // match old email and phone no
     $u_exist = select("SELECT * FROM `staff` WHERE (`StaffEmail`=? OR `StaffPhoneNo`=?)  LIMIT 1", [trim($frm_data['StaffEmail']), trim($frm_data['StaffPhoneNo'])], 'ss');

    if(mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if($u_exist_fetch['StaffEmail'] == $frm_data['StaffEmail']) {
            echo 'email_already';
        } elseif($u_exist_fetch['StaffPhoneNo'] == $frm_data['StaffPhoneNo']) {
            echo 'phone_already';
        } 
        exit;
    }

    $img_r = uploadImage($_FILES['StaffPic'], ADMIN_FOLDER);
    if ($img_r == 'invalid_img') {
        echo $img_r;
    } else if ($img_r == "invalid_size") {
        echo $img_r;
    } else if ($img_r == "upload_failed") {
        echo $img_r;
    } else {
   

            // encrypt password
        $enc_pass = password_hash($frm_data['StaffPassword'], PASSWORD_BCRYPT);

        // Insert data into the staff table
        $q = "INSERT INTO `staff`(`StaffFullName`, `StaffNRC`, `StaffDOB`, `StaffPhoneNo`, `Street`, `Township`, `City`, `PositionNo`, `StaffEmail`, `StaffPassword`, `StaffPic`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $values = [
            $frm_data['StaffFullName'],
            $frm_data['StaffNRC'],
            $frm_data['StaffDOB'],
            $frm_data['StaffPhoneNo'],
            $frm_data['Street'],
            $frm_data['Township'],
            $frm_data['City'],
            $frm_data['PositionNo'],
            
            $frm_data['StaffEmail'],
            $enc_pass,
            $img_r
        ];
        $res = insert($q, $values, 'sssisssisss');

        if ($res === true) {
            echo "Staff added successfully";
        } else {
            // Handle insertion error
            echo "Error adding staff: " . $res;
        }
    }
}

// get all staff to display
if(isset($_POST['get_all_staff'])){
    $res =  mysqli_query($con, "SELECT staff.*, position.PositionName FROM staff INNER JOIN position ON staff.PositionNo = position.PositionNo");
    $i = 1;
    $data = "";
    $path = ADMIN_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        $data .= "
            <tr >
                <td>$i</td>
                <td>$row[StaffFullName]</td>
                <td>$row[StaffNRC]</td>
                <td>$row[StaffDOB]</td>
                <td>$row[StaffPhoneNo]</td>
                <td>$row[Street]</td>
                <td>$row[Township]</td>
                <td>$row[City]</td>
                <td>$row[PositionName]</td>
                <td>$row[StaffEmail]</td>
                
                <td><img src=$path$row[StaffPic] width='90px'></td>
                <td>
                        <button type='button' onclick='edit_staff($row[StaffID])' class='btn btn-primary  shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-staff'>
                            <i class='bi bi-pencil-square'></i>
                        </button>
                        <button onclick='rem_staff($row[StaffID])' class='btn btn-danger btn-sm shadow-none m-1'><i class='bi bi-trash'></i> </button>

                    </td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}
// for edit form
if(isset($_POST['get_staff'])){
    $frm_data = filtration($_POST);
    $path = ADMIN_IMG_PATH;
    $res = select("SELECT * FROM `staff` WHERE `StaffID` = ?", [$frm_data['get_staff']], 'i');

    $staffdata = mysqli_fetch_assoc($res);
    // Construct the correct image URL based on the site URL and image path
    $staffdata['image_path'] = $path . $staffdata['StaffPic'];

    // Convert the array to JSON before echoing
    $data = ['staffdata' => $staffdata];
    echo json_encode($data);
}



if (isset($_POST["edit_staff"])) {
    $frm_data = filtration($_POST);
    $flag = 0;
    $img_n = "";

     // match password and confirm password
    if($frm_data['StaffPassword'] != $frm_data['edit_staff_confirm']){
        echo 'pass_mismatch';
        exit;
    }

    // Check if 'staff_pic' file input field exists in $_FILES
    if (!empty($_FILES['StaffPic']['name'])) {
        // A new image is uploaded
        $new_img_path = uploadImage($_FILES['StaffPic'], ADMIN_FOLDER);
        if ($new_img_path == 'invalid_img' || $new_img_path == 'invalid_size' || $new_img_path == 'upload_failed') {
            echo $new_img_path;
            exit; // Stop further processing
        }
        // Update with new image path
        $frm_data['StaffPic'] = $new_img_path;
    } else {
        // No new image uploaded, retain the existing image path if available
        $frm_data['StaffPic'] = isset($frm_data['StaffPic']) ? $frm_data['StaffPic'] : null;
    }

      // encrypt password
    $enc_pass = password_hash($frm_data['StaffPassword'], PASSWORD_BCRYPT);

    // Update
    $q = "UPDATE `staff` SET `StaffFullName`=?, `StaffNRC`=?, `StaffDOB`=?, `StaffPhoneNo`=?, `Street`=?, `Township`=?, `City`=?, `PositionNo`=?, `StaffEmail`=?, `StaffPassword`=?, `StaffPic`=? WHERE `StaffID`=?";
    $values = [
        $frm_data['StaffFullName'],
        $frm_data['StaffNRC'],
        $frm_data['StaffDOB'],
        $frm_data['StaffPhoneNo'],
        $frm_data['Street'],
        $frm_data['Township'],
        $frm_data['City'],
        $frm_data['PositionNo'],
        $frm_data['StaffEmail'],
        $enc_pass,
        $frm_data['StaffPic'], // Use the value from $frm_data
        $frm_data['StaffID']
    ];

    // Execute the query
    if (update($q, $values, 'sssisssisssi')) {
        $flag = 1;
    } else {
        $flag = 0;
        // Handle update failure
        echo "Error updating staff: " . mysqli_error($con);
    }

    // Output success or failure based on $flag
    echo $flag ? 1 : 0;
}

if (isset($_POST['rem_staff'])){
    $frm_data = filtration($_POST);
    $values = [$frm_data['rem_staff']];

    $pre_q = "SELECT * FROM `staff` WHERE `StaffID`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);
    if(deleteImage($img['StaffPic'],ADMIN_FOLDER)){
         $q = "DELETE FROM `staff` WHERE `StaffID`=?";
        $res = delete($q,$values,'i');
        echo $res;
    }
    else{
        echo 0;
    }

}



?>
