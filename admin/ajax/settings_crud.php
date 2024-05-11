<?php
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

// general
if(isset($_POST['get_general']))
{
    $q = "SELECT * FROM `settings` WHERE `Sr_no` =? ";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);

    echo $json_data;
}
if (isset($_POST['upd_general'])) {
        // Sanitize and filter the POST data
        $frm_data = filtration($_POST);

        // Check if sr_no is set in the POST data
        $sr_no = isset($_POST['Sr_no']) ? $_POST['Sr_no'] : 1;

        // Updating the settings table with new data
        $q = "UPDATE `settings` SET `Title`=?,`Mission`=?,`Vision`=?,`Origin`=?,`about`=? WHERE `Sr_no`=?";
        $values = [$frm_data['site_title'],$frm_data['mission'], $frm_data['vision'],$frm_data['origin'],$frm_data['site_about'], $sr_no];
        $res = update($q, $values, 'sssssi');

        // Output the result of the update operation (success/failure)
        echo $res;
    }

// shutdown
if (isset($_POST['upd_shutdown'])) {
        // Sanitize and filter the POST data
        $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

        // Check if sr_no is set in the POST data
        $sr_no = isset($_POST['Sr_no']) ? $_POST['Sr_no'] : 1;

        // Updating the settings table with new data
        $q = "UPDATE `settings` SET `shutdown`=? WHERE `Sr_no`=?";
        $values = [$frm_data, $sr_no];
        $res = update($q, $values, 'ii');

        // Output the result of the update operation (success/failure)
        echo $res;
    }
// postion

 if (isset($_POST['add_position'])) {
    $frm_data = filtration($_POST);
    $q = "INSERT INTO `position`( `PositionName`, `DepartmentName`) VALUES (?,?)";
    $values = [$frm_data["PositionName"], $frm_data["DepartmentName"]];
    $res = insert($q,$values,'ss');
   echo $res;
}

if (isset($_POST['get_positions'])) {
    $res = selectAll('position');
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr class='text-left'>
                <td>$i</td>
               
                <td>$row[PositionName]</td>
                <td>$row[DepartmentName]</td>
                <td>
                    <button type='button' onclick='edit_position($row[PositionNo])' class='btn btn-primary  shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-position'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button onclick="rem_position($row[PositionNo])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            
        data;
        $i++;
    }
}


if(isset($_POST['get_edit_positions'])){
    $frm_data = filtration($_POST);
    $res = select("SELECT * FROM `position` WHERE `PositionNo` = ?", [$frm_data['get_edit_positions']], 'i');

    $positiondata = mysqli_fetch_assoc($res);
    
    $data = ['position_data' => $positiondata];
    echo json_encode($data);
}
if (isset($_POST["edit_position"])) {
    $frm_data = filtration($_POST);
    $flag = 0;

    $q = "UPDATE `position` SET `PositionName`=?,`DepartmentName`=? WHERE `PositionNo`=?";
    $values = [
        $frm_data['positionName'],
        $frm_data['dept'],
        $frm_data['positionNo'],
      
    ];
    if (update($q, $values, 'ssi')) {
        $flag = 1;
    } else {
        $flag = 0;
        // Handle update failure
        echo "Error updating position: " . mysqli_error($con);
    }

    // Output success or failure based on $flag
    echo $flag ? 1 : 0;
}

if (isset($_POST['rem_position'])){
    $frm_data = filtration($_POST);
    $values = [$frm_data['rem_position']];

    
    $q = "DELETE FROM `position` WHERE `PositionNo`=?";
    $res = delete($q,$values,'i');
    echo $res;
}
?>