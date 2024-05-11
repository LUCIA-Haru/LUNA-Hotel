<?php 
require('../files/essentials.php');
require('../files/db_config.php');
adminLogin();

if (isset($_POST['add_feature'])) {
    $frm_data = filtration($_POST);
    $q = "INSERT INTO `feature`( `FeatureName`, `FeatureDescription`) VALUES (?,?)";
    $values = [$frm_data["FeatureName"], $frm_data["FeatureDescription"]];
    $res = insert($q,$values,'ss');
   echo $res;
}

if (isset($_POST['get_features'])) {
    $res = selectAll('feature');
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr class='text-left'>
                <td>$i</td>
                <td>$row[FeatureName]</td>
                <td>$row[FeatureDescription]</td>
                <td>
                <button type='button' onclick='edit_feature($row[FeatureID])' class='btn btn-primary  shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-feature'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button onclick="rem_features($row[FeatureID])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            
        data;
        $i++;
    }
}
if (isset($_POST['rem_features'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['rem_features']];

    $check_q =select("SELECT * FROM `rt_features` WHERE `FeatureID`=?",[$frm_data['rem_features']],'i');

    if (mysqli_num_rows($check_q)==0) {
        
        $q = "DELETE FROM `feature` WHERE `FeatureID`=?";
           $res = delete($q,$values,'i');

           echo $res;
        
    }
    else{
        echo 'roomtype_added';
    }

    
}
if(isset($_POST['get_edit_features'])){
    $frm_data = filtration($_POST);
    $res = select("SELECT * FROM `feature` WHERE `FeatureID` = ?", [$frm_data['get_edit_features']], 'i');

    $featuredata = mysqli_fetch_assoc($res);
    
    $data = ['edit_feature_data' => $featuredata];
    echo json_encode($data);
}
if (isset($_POST["edit_feature"])) {
    $frm_data = filtration($_POST);
    $flag = 0;

    $q = "UPDATE `feature` SET `FeatureName`=?,`FeatureDescription`=? WHERE `FeatureID`=?";
    $values = [
        $frm_data['featureName'],
        $frm_data['desc'],
        $frm_data['featureid'],
      
    ];
    if (update($q, $values, 'ssi')) {
        $flag = 1;
    } else {
        $flag = 0;
        // Handle update failure
        echo "Error updating feature: " . mysqli_error($con);
    }

    // Output success or failure based on $flag
    echo $flag ;
}   

// Amenities
if(isset($_POST['add_amenities'])){
    $frm_data = filtration($_POST);

    $img_r = uploadSVGImage($_FILES['AmenitiesIcon'], AMENITIES_FOLDER);
    if($img_r == "invalid_img"){
        echo $img_r;
    }
     else if($img_r == "invalid_size"){
        echo $img_r;
    }
    else if($img_r == "upload_failed"){
        echo $img_r;
    }
    else{
        $q = "INSERT INTO `amenities`( `AmenitiesIcon`, `AmenitiesName`) VALUES (?,?)";
        $values = [$img_r,$frm_data["AmenitiesName"]];
        $res = insert($q, $values, 'ss');
        echo $res;
    }
}
if(isset($_POST['get_amenities'])){
    $res = selectAll('amenities');
    $i = 1;

    $path = AMENITIES_IMG_PATH;
    while($row = mysqli_fetch_assoc($res))
    {
        echo <<<data
            <tr class="align middle">
                <td>$i</td>
                <td><img src="$path$row[AmenitiesIcon]" width="60px"></td>
                <td>$row[AmenitiesName]</td>
                
                <td>
                <button type='button' onclick='edit_amenities($row[AmenitiesID])' class='btn btn-primary  shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-amenities'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button onclick="rem_amenities($row[AmenitiesID])" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            
        data;
        $i++;
    }
}


if(isset($_POST['get_edit_amenities'])){
    $frm_data = filtration($_POST);
    $path = AMENITIES_IMG_PATH;
    $res = select("SELECT * FROM `amenities` WHERE `AmenitiesID` = ?", [$frm_data['get_edit_amenities']], 'i');

    $amenitiesdata = mysqli_fetch_assoc($res);
    // Construct the correct image URL based on the site URL and image path
    $amenitiesdata['image_path'] = $path . $amenitiesdata['AmenitiesIcon'];

    // Convert the array to JSON before echoing
    $data = ['edit_amenities_data' => $amenitiesdata];
    echo json_encode($data);
}



if (isset($_POST["edit_amenities"])) {
    $frm_data = filtration($_POST);
    $flag = 0;

    // Check if a new image file is uploaded
    if (isset($_FILES['amenitiesIcon']) && $_FILES['amenitiesIcon']['size'] > 0) {
        // New image is uploaded, proceed with image update logic
        // Fetching old image and deleting it
        $icon_exist = select("SELECT `AmenitiesIcon` FROM `amenities` WHERE `AmenitiesID` =?", [$frm_data['amenitiesID']], 'i');
        $icon_fetch = mysqli_fetch_assoc($icon_exist);

        deleteImage($icon_fetch['AmenitiesIcon'], AMENITIES_FOLDER);

        // Upload icon image to server
        $img = uploadSVGImage($_FILES['amenitiesIcon'], AMENITIES_FOLDER);

        if ($img == 'invalid_img') {
            echo 'invalid_img';
            exit;
        } else if ($img == 'upload_failed') {
            echo 'upload_failed';
            exit;
        }
    } else {
        // No new image uploaded, retain the old image
        $img = select("SELECT `AmenitiesIcon` FROM `amenities` WHERE `AmenitiesID` =?", [$frm_data['amenitiesID']], 'i')->fetch_object()->AmenitiesIcon;
    }

    // Update name and image in the database
    $query = "UPDATE `amenities` SET `AmenitiesIcon`=?, `AmenitiesName`=? WHERE `AmenitiesID`=?";
    $values = [$img, $frm_data['amenitiesName'], $frm_data['amenitiesID']];

    if (update($query, $values, 'ssi')) {
        echo 1;
    } else {
        echo 0;
    }
}



if (isset($_POST['rem_amenities'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['rem_amenities']];

    $check_q =select("SELECT * FROM rt_amenities WHERE `AmenitiesID`=?",[$frm_data['rem_amenities']],'i');

    if(mysqli_num_rows($check_q)==0){

        $pre_q = "SELECT * FROM amenities WHERE `AmenitiesID`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        // Delete the associated image
        if (deleteImage($img['AmenitiesIcon'], AMENITIES_FOLDER)) {
            // Delete the amenities record
            $q = "DELETE FROM amenities WHERE `AmenitiesID`=?";
            $res = delete($q, $values, 'i');
            echo $res;
        
    }else{
         echo 0;
    }
    } 
    else{
        echo "roomtype_added";
    }
}


?> 