<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

if (isset($_POST['add_roomtype'])) {
    $features = filtration(json_decode($_POST['Features']));
    $amenities = filtration(json_decode($_POST['Amenities']));

    $frm_data = filtration($_POST);
    $flag = 0;
    
    $q1 = "INSERT INTO `roomtype`( `RTName`, `Adult`, `Children`, `Area`, `From_Floor`,`To_Floor`,`RTQuantity`, `PricePerNight`, `RTDescription`) VALUES (?,?,?,?,?,?,?,?,?)";
     $values = [$frm_data['RTName'],$frm_data['Adult'],$frm_data['Children'],$frm_data['Area'],$frm_data['From_Floor'],$frm_data['To_Floor'],$frm_data['Quantity'],$frm_data['Price-Per-Night'],$frm_data['Description']];

    if (insert($q1, $values, 'siiiiiiis')){
        $flag = 1;
    }

    $RTID=mysqli_insert_id($con);//retrieving the last id

    $q2 = "INSERT INTO `rt_features`(`RTID`, `FeatureID`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con,$q2)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $RTID, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }


    $q3 = "INSERT INTO `rt_amenities`(`RTID`, `AmenitiesID`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con,$q3)) {
        foreach ($amenities as $a) {
            mysqli_stmt_bind_param($stmt, 'ii', $RTID, $a);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }

    echo $flag ? 1 : 0;
    
 }


if(isset($_POST['get_all_roomtype'])){
    // id
//      $q = "SELECT roomtype.*, GROUP_CONCAT(rt_features.FeatureID) AS features, GROUP_CONCAT(rt_amenities.AmenitiesID) AS amenities 
// //           FROM roomtype 
// //           LEFT JOIN rt_features ON roomtype.RTID = rt_features.RTID 
// //           LEFT JOIN rt_amenities ON roomtype.RTID = rt_amenities.RTID 
// //           GROUP BY roomtype.RTID";


    // Name
   
   $q = "SELECT roomtype.*, 
             GROUP_CONCAT(DISTINCT feature.FeatureName) AS features, 
             GROUP_CONCAT(DISTINCT amenities.AmenitiesName) AS amenities 
      FROM roomtype 
      LEFT JOIN rt_features ON roomtype.RTID = rt_features.RTID 
      LEFT JOIN feature ON rt_features.FeatureID = feature.FeatureID 
      LEFT JOIN rt_amenities ON roomtype.RTID = rt_amenities.RTID 
      LEFT JOIN amenities ON rt_amenities.AmenitiesID = amenities.AmenitiesID 
      GROUP BY roomtype.RTID";


    $res = mysqli_query($con, $q);

    $i = 1;
    $data = "";

    while($row = mysqli_fetch_assoc($res)){
        if($row['RTStatus']==1){
            $status = "<button onclick='toggleStatus($row[RTID],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
        }else{
            $status = "<button onclick='toggleStatus($row[RTID],1)' class='btn btn-warning btn-sm shadow-none'>InActive</button>";
        }
        $data .= "
            <tr >
                <td>$i</td>
                <td>{$row['RTName']}</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>Adult:{$row['Adult']}</span>
                    <span class='badge rounded-pill bg-light text-dark'>Children:{$row['Children']}</span>
                </td>
                <td>{$row['Area']}sq.ft</td>
                <td>{$row['From_Floor']}F~{$row['To_Floor']}F</td>
                <td>{$row['features']}</td>
                <td>{$row['amenities']}</td>
                <td>{$row['RTQuantity']}</td>
                <td>$ {$row['PricePerNight']}</td>
                <td>{$row['RTDescription']}</td>
                <td>$status</td>
                <td class='flex justify-content-around'>
                    <button type='button' onclick='edit_rt_details({$row['RTID']})' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-roomtype'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                   <button type='button' onclick=\"get_RTimg('$row[RTID]', '$row[RTName]')\" class='btn btn-info shadow-none btn-sm mt-1' data-bs-toggle='modal' data-bs-target='#rt-images'>
                        <i class='bi bi-image'></i>
                    </button>
                    <button type='button' onclick='remove_rt({$row['RTID']})' class='btn btn-danger shadow-none btn-sm mt-1'>
                        <i class='bi bi-trash'></i>
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}

// get roomtype for edit
if(isset($_POST['get_roomtype'])){
    $frm_data = filtration($_POST);

    $res1 = select("SELECT * FROM `roomtype` WHERE RTID = ? ", [$frm_data['get_roomtype']],'i');
    $res2 = select("SELECT * FROM `rt_features` WHERE RTID = ? ", [$frm_data['get_roomtype']],'i');
    $res3 = select("SELECT * FROM `rt_amenities` WHERE RTID = ? ", [$frm_data['get_roomtype']],'i');

    $rtdata = mysqli_fetch_assoc($res1);
    $features = [];
    $amenities = [];

    if(mysqli_num_rows($res2)>0){
        while ($row =mysqli_fetch_assoc( $res2 )) {
            array_push($features, $row['FeatureID']);
        }
    }
    if(mysqli_num_rows($res3)>0){
        while ($row =mysqli_fetch_assoc( $res3 )) {
            array_push($amenities, $row['AmenitiesID']);
        }
    }
    $data = ["roomtype_data" => $rtdata, "features" => $features, "amenities" => $amenities];

     echo $data = json_encode($data);
    
}

if(isset($_POST['edit_roomtype'])){
    $features = filtration(json_decode($_POST['Features']));
    $amenities = filtration(json_decode($_POST['Amenities']));

    $frm_data = filtration($_POST);
    $flag = 0;

    $q1 = "UPDATE `roomtype` SET `RTName`=?,`Adult`=?,`Children`=?,`Area`=?,`From_Floor`=?,`To_Floor`=?,`RTQuantity`=?,`PricePerNight`=?,`RTDescription`= ? WHERE `RTID`=?";
    $values = [$frm_data['RTName'], $frm_data['Adult'], $frm_data['Children'], $frm_data['Area'],$frm_data['From_Floor'],$frm_data['To_Floor'], $frm_data['Quantity'], $frm_data['Price-Per-Night'], $frm_data['Description'], $frm_data['RTID']];

    if(update($q1,$values,'siiiiiiisi')){
        $flag = 1;
    }
    $del_features = delete("DELETE FROM `rt_features` WHERE `RTID` = ? ", [$frm_data["RTID"]],'i');
    $del_amenities = delete("DELETE FROM `rt_amenities` WHERE `RTID` = ? ", [$frm_data["RTID"]],'i');

    // Check if deletion was successful or not
    if(!($del_features && $del_amenities)){
        $flag = 0;
    }
    // Reinsert no data
    $q2 = "INSERT INTO `rt_features`(`RTID`, `FeatureID`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con,$q2)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['RTID'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    }else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }


    $q3 = "INSERT INTO `rt_amenities`(`RTID`, `AmenitiesID`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con,$q3)) {
        foreach ($amenities as $a) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['RTID'], $a);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    }else{
        $flag = 0;
        die('query cannot be prepared - insert');
    }

    echo $flag ? 1 : 0;

}

// remove rt
if (isset($_POST["remove_rt"])) {
    $frm_data = filtration($_POST);

    // Delete associated images
    $res1 = select("SELECT * FROM `rt_images` WHERE `RTID`=?", [$frm_data['RTID']], 'i');
    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['RTImages'], RT_FOLDER);
    }

    // Delete associated data from other tables
    $res2 = delete("DELETE FROM `rt_images` WHERE `RTID`=?", [$frm_data['RTID']], 'i');
    $res3 = delete("DELETE FROM `rt_features` WHERE `RTID`=?", [$frm_data['RTID']], 'i');
    $res4 = delete("DELETE FROM `rt_amenities` WHERE `RTID`=?", [$frm_data['RTID']], 'i');
    $res5 = delete("DELETE FROM `roomtype` WHERE `RTID`=?", [$frm_data['RTID']], 'i');

    if (!$res2) {
        echo "Failed to delete image";
    } elseif (!$res3) {
        echo "Failed to delete features";
    } elseif (!$res4) {
        echo "Failed to delete amenities.";
    } elseif (!$res5) {
        echo "Failed to delete roomtype.";
    } else {
        echo 1; 
    }
    
}


// images
if(isset($_POST['add_RTimg'])){
    $frm_data = filtration($_POST);

    $img_r = uploadImage($_FILES['RTImages'], RT_FOLDER);
    if ($img_r == 'invalid_img') {
        echo $img_r;
    } else if ($img_r == "invalid_size") {
        echo $img_r;
    } else if ($img_r == "upload_failed") {
        echo $img_r;
    } else {
        $q = "INSERT INTO `rt_images`(`RTImages`,`RTID`) VALUES (?,?)";
        $values = [$img_r,$frm_data['RTID']];
        $res = insert($q, $values, 'si');
        echo $res;
    }
}
if(isset($_POST['get_RTimg'])){
    $frm_data = filtration($_POST);
    $res = select("SELECT * FROM `rt_images` WHERE `RTID`=?",[$frm_data['get_RTimg']],'i');
    $i=0;

    $path = RT_IMG_PATH;

    while($row = mysqli_fetch_assoc(($res))){
        if($row['Active'] == 1) {
            $active_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
        } else {
            $active_btn = "<button onclick='active_img({$row['ImgID']},{$row['RTID']})' class='btn btn-secondary'><i class='bi bi-check-lg'></i></button>";
        }

        echo <<<data
            <tr class='align-middle'>
            <td><img src='$path$row[RTImages]' class='img-fluid'></td>
            <td>$active_btn</td>
            <td><button onclick='rem_RTimage($row[ImgID],$row[RTID])' class='btn btn-danger btn-sm shadow-none'>
                    <i class='bi bi-trash'></i>
                </button></td>

            </tr>
        data;
        $i++;
    }


   
}
if (isset($_POST['rem_RTimage'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['ImgID'], $frm_data['RTID']]; 

    $pre_q = "SELECT * FROM `rt_images` WHERE `ImgID`=? AND `RTID`=?";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['RTImages'], RT_FOLDER)) {
        $q = "DELETE FROM `rt_images` WHERE `ImgID`=? AND `RTID`=?";
        $res = delete($q, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }
}
if (isset($_POST['active_img'])) {
    $frm_data = filtration($_POST);

    // Update all rows with RTID to set Active to 0
    $pre_q = "UPDATE `rt_images` SET `Active`=? WHERE RTID = ?";
    $pre_v = [0, $frm_data['RTID']];
    $pre_res = update($pre_q, $pre_v, 'ii');

    // Update a specific row with ImgID and RTID to set Active to 1
    $q = "UPDATE `rt_images` SET `Active`=? WHERE ImgID= ? AND RTID = ?";
    $v = [1, $frm_data['ImgID'], $frm_data['RTID']];
    $res = update($q, $v, 'iii');

    echo $res; 
}




















// toggle
if(isset($_POST['toggleStatus'])){
    $frm_data = filtration($_POST);

    $q = "UPDATE `roomtype` SET `RTStatus`= ? WHERE `RTID`=?";
    $v = [$frm_data['value'], $frm_data['toggleStatus']];

    if(update($q,$v,'ii')){
        echo 1;
    }else{
        echo 0;
    }
}




?>
