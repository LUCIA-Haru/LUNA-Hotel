let add_feature_form = document.getElementById("add_feature_form");
add_feature_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_feature();
});

function add_feature() {
  let data = new FormData();
  data.append("add_feature", "");
  data.append("FeatureName", add_feature_form.elements["feature_name"].value);
  data.append(
    "FeatureDescription",
    add_feature_form.elements["feature_desc"].value
  );

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("add-features");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText.trim() === "1") {
      alert("success", "New feature added");
      add_feature_form.reset();
      get_features();
    } else {
      alert("error", "Failed to add features!");
    }
  };
  xhar.send(data);
}
function get_features() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("features_data").innerHTML = this.responseText;
  };
  xhar.send("get_features");
}
function rem_features(val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "features Removed");
      get_features();
    } else if (this.responseText.trim() === "roomtype_added") {
      alert("error", "Failed!Feature is added in room!");
    } else {
      alert("error", "Failed!");
    }
  };
  xhar.send("rem_features=" + val);
}
// edit feature
let edit_feature_form = document.getElementById("edit_feature_form");

function edit_feature(featureId) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_feature_form.elements["feature_name"].value =
      data.edit_feature_data.FeatureName;
    edit_feature_form.elements["feature_desc"].value =
      data.edit_feature_data.FeatureDescription;
    document.getElementById("edit_features_id").value = featureId;
  };
  xhar.send("get_edit_features=" + featureId);
}

edit_feature_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_feature();
});

function submit_edit_feature() {
  let data = new FormData();

  data.append("edit_feature", "");
  data.append("featureid", edit_feature_form.elements["features_id"].value);
  data.append("featureName", edit_feature_form.elements["feature_name"].value);
  data.append("desc", edit_feature_form.elements["feature_desc"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-feature");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText.trim() === "1") {
      alert("success", "Feature Data Updated");
      edit_feature_form.reset();
      get_features();
    } else {
      alert("error", "No data changed");
    }
  };

  xhar.send(data);
}
// Amenities
let add_amenities_form = document.getElementById("add_amenities_form");

add_amenities_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_amenities();
});

function add_amenities() {
  let data = new FormData();
  data.append("add_amenities", "");
  data.append(
    "AmenitiesIcon",
    add_amenities_form.elements["amenities_icon"].files[0]
  );
  data.append(
    "AmenitiesName",
    add_amenities_form.elements["amenities_name"].value
  );

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/f_a_crud.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById("add-amenities");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == "invalid_img") {
      alert("error", "Only SVG  images are allowed!");
    } else if (this.responseText == "invalid_size") {
      alert("error", "Icon should be less than 2MB!");
    } else if (this.responseText == "upload_failed") {
      alert("error", "Images upload failed.Server Down");
    } else {
      alert("success", "New Amenities added");
      add_amenities_form.reset();
      get_amenities();
    }
  };
  xhr.send(data);
}
function get_amenities() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("amenities_data").innerHTML = this.responseText;
  };
  xhar.send("get_amenities");
}
function rem_amenities(val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "amenities Removed");
      get_amenities();
    } else if (this.responseText.trim() === "roomtype_added") {
      alert("error", "Failed!Amenities is added in room!");
    } else {
      alert("error", "Failed!");
    }
  };

  xhar.send("rem_amenities=" + val);
}

// edit position
let edit_amenities_form = document.getElementById("edit_amenities_form");

function edit_amenities(amenitiesID) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_amenities_form.elements["amenities_name"].value =
      data.edit_amenities_data.AmenitiesName;
    document.getElementById("edit_amenities_id").value = amenitiesID;
    document.getElementById("amenities_icon_show").src =
      data.edit_amenities_data.image_path;
  };
  xhar.send("get_edit_amenities=" + amenitiesID);
}

edit_amenities_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_amenities();
});

function submit_edit_amenities() {
  let data = new FormData();

  data.append("edit_amenities", "");
  data.append(
    "amenitiesID",
    edit_amenities_form.elements["amenities_id"].value
  );
  data.append(
    "amenitiesName",
    edit_amenities_form.elements["amenities_name"].value
  );
  data.append(
    "amenitiesIcon",
    edit_amenities_form.elements["amenities_icon"].files[0]
  );

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/f_a_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-amenities");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == "invalid_img") {
      alert("error", "Only SVG images are allowed!");
    } else if (this.responseText == "invalid_size") {
      alert("error", "Icon should be less than 2MB!");
    } else if (this.responseText == "upload_failed") {
      alert("error", "Images upload failed. Server Down");
    } else if (this.responseText.trim() === "1") {
      alert("success", "Amenities Data Updated");

      edit_amenities_form.reset();
      get_amenities();
    } else {
      alert("error", "No data changed");
    }
  };

  // Send the FormData object with the request
  console.log(data);
  xhar.send(data);
}

// Function Calls

document.addEventListener("DOMContentLoaded", function () {
  get_features();
  get_amenities();
});
