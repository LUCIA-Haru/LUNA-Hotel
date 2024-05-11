<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $frm_data = filtration($_POST);
    $q = "INSERT INTO `room`( `RoomNumber`, `FloorNo`,`RTID`) VALUES (?,?,?)";
    $values = [$frm_data["RoomNumber"], $frm_data["FloorNo"],$frm_data["RT"]];
    $res = insert($q,$values,'sii');
   echo $res;
}

if (isset($_POST['get_rooms'])) {
    $res =  mysqli_query($con, "SELECT room.*, roomtype.RTName FROM room INNER JOIN roomtype ON room.RTID = roomtype.RTID");
    $i = 1;


    while ($row = mysqli_fetch_assoc($res)) {
         

        if($row['RoomStatus']==1){
            $status = "<button onclick='room_toggleStatus($row[RoomID],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
        }else{
            $status = "<button onclick='room_toggleStatus($row[RoomID],1)' class='btn btn-warning btn-sm shadow-none'>InActive</button>";
        }

        echo <<<data
            <tr>
                <td>$i</td>
                <td>$row[RoomNumber]</td>
                <td>$row[FloorNo]</td>
                <td>$row[RTName]</td>
                
                <td>$status </td>
                <td>
                <button type='button' onclick='edit_rooms($row[RoomID])' class='btn btn-primary  shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-rooms'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button onclick="rem_rooms($row[RoomID])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            
        data;
        $i++;
    }
}
if (isset($_POST['rem_rooms'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['rem_rooms']];

     $q = "DELETE FROM `room` WHERE `RoomID`=?";
        $res = delete($q,$values,'i');
        echo $res;
}



if(isset($_POST['get_edit_rooms'])){
    $frm_data = filtration($_POST);
    $res = select("SELECT * FROM `room` WHERE  `RoomID` =?", [$frm_data['get_edit_rooms']], 'i');

    $roomsdata = mysqli_fetch_assoc($res);
    
    $data = ['edit_rooms_data' => $roomsdata];
    echo json_encode($data);
}
if (isset($_POST["edit_rooms"])) {
    $frm_data = filtration($_POST);
    $flag = 0;

    $q = "UPDATE `room` SET `RoomNumber`=?, `FloorNo`=?,`RTID`=? WHERE `RoomID`=?";
    $values = [
        $frm_data['roomno'],
        $frm_data['floorno'],
        $frm_data['rt'],
        $frm_data['roomid']
      
    ];
    if (update($q, $values, 'siii')) {
        $flag = 1;
    } else {
        $flag = 0;
        // Handle update failure
        echo "Error updating rooms: " . mysqli_error($con);
    }

    // Output success or failure based on $flag
    echo $flag ? 1 : 0;
}






// toggle
if(isset($_POST['room_toggleStatus'])){
    $frm_data = filtration($_POST);

    $q = "UPDATE `room` SET `RoomStatus`= ? WHERE `RoomID`=?";
    $v = [$frm_data['value'], $frm_data['room_toggleStatus']];

    if(update($q,$v,'ii')){
        echo 1;
    }else{
        echo 0;
    }
}








?>