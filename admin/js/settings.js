let general_data;

// General
let general_s_form = document.getElementById("general_s_form");
let site_title_inp = document.getElementById("site_title_inp");
let mission_inp = document.getElementById("mission_inp");
let vision_inp = document.getElementById("vision_inp");
let origin_inp = document.getElementById("origin_inp");
let site_about_inp = document.getElementById("site_about_inp");

function get_general() {
  let site_title = document.getElementById("site_title");
  let mission = document.getElementById("mission");
  let vision = document.getElementById("vision");
  let origin = document.getElementById("origin");
  let site_about = document.getElementById("site_about");

  let shutdown_toggle = document.getElementById("shutdown-toggle");

  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    general_data = JSON.parse(this.responseText);

    // Update page elements with data from the response
    site_title.innerText = general_data.Title;
    mission.innerText = general_data.Mission;
    vision.innerText = general_data.Vision;
    origin.innerText = general_data.Origin;
    site_about.innerText = general_data.about;

    site_title_inp.value = general_data.Title;
    mission_inp.value = general_data.Mission;
    vision_inp.value = general_data.Vision;
    origin_inp.value = general_data.Origin;
    site_about_inp.value = general_data.about;

    // Update the shutdown toggle based on the shutdown value in the response
    if (general_data.shutdown == 0) {
      shutdown_toggle.checked = false;
      shutdown_toggle.value = 0;
    } else {
      shutdown_toggle.checked = true;
      shutdown_toggle.value = 1;
    }
  };

  xhar.send("get_general");
}
// general_s_form
general_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_general(
    site_title_inp.value,
    mission_inp.value,
    vision_inp.value,
    origin_inp.value,
    site_about_inp.value
  );
});
function handleCancelClick(event) {
  event.preventDefault();
  site_title_inp.value = general_data.Title;
  mission_inp.value = general_data.Mission;
  vision_inp.value = general_data.Vision;
  origin_inp.value = general_data.Origin;
  site_about_inp.value = general_data.about;
}
function upd_general(
  site_title_val,
  mission_val,
  vision_val,
  origin_val,
  site_about_val
) {
  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // When it's done, parse the results and call the callback function that was
  xhar.onload = function () {
    // from bootstrap modal js
    var myModal = document.getElementById("general-s");
    var modal = bootstrap.Modal.getInstance(myModal);

    modal.hide();

    if (this.responseText == 1) {
      alert("success", "Changes Are Saved!!");
      get_general();
    } else {
      alert("error", "No changes Are Saved!");
    }
  };

  // The data to be sent in the request
  let data =
    "site_title=" +
    encodeURIComponent(site_title_val) +
    "&mission=" +
    encodeURIComponent(mission_val) +
    "&vision=" +
    encodeURIComponent(vision_val) +
    "&origin=" +
    encodeURIComponent(origin_val) +
    "&site_about=" +
    encodeURIComponent(site_about_val) +
    "&upd_general=true";

  // Send the request with the data
  xhar.send(data);
}

// Shutdown
function upd_shutdown(val) {
  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // When it's done, parse the results and call the callback function that was
  xhar.onload = function () {
    if (this.responseText == 1 && general_data.shutdown == 0) {
      alert("success", "Website has been shutdown!");
    } else {
      alert("success", "Shutdown mode off!");
    }
    get_general();
  };

  // Send the request with the data
  xhar.send("upd_shutdown=" + val);
}

// Positions
let add_position_form = document.getElementById("add_position_form");
add_position_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_position();
});
function add_position() {
  let data = new FormData();
  data.append("add_position", "");
  data.append(
    "DepartmentName",
    add_position_form.elements["position_dept"].value
  );
  data.append(
    "PositionName",
    add_position_form.elements["position_name"].value
  );

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("add-position");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "New Position Data added");
      add_position_form.reset();
      get_positions();
    } else {
      alert("error", "Failed to add postion!");
    }
  };
  xhar.send(data);
}
function get_positions() {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    document.getElementById("position_data").innerHTML = this.responseText;
  };
  xhar.send("get_positions");
}

// edit position
let edit_position_form = document.getElementById("edit_position_form");

function edit_position(PositionNo) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    console.log(JSON.parse(this.responseText));
    let data = JSON.parse(this.responseText);
    edit_position_form.elements["position_name"].value =
      data.position_data.PositionName;
    edit_position_form.elements["position_dept"].value =
      data.position_data.DepartmentName;
    document.getElementById("edit_position_no").value = PositionNo;
  };
  xhar.send("get_edit_positions=" + PositionNo);
}

edit_position_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_position();
});

function submit_edit_position() {
  let data = new FormData();

  data.append("edit_position", "");
  data.append("positionNo", edit_position_form.elements["PositionNo"].value);
  data.append(
    "positionName",
    edit_position_form.elements["position_name"].value
  );
  data.append("dept", edit_position_form.elements["position_dept"].value);

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-position");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == "1") {
      alert("success", "Position Data Updated");
      edit_position_form.reset();
      get_positions();
    } else {
      alert("error", "No data changed");
    }
  };

  xhar.send(data);
}
function rem_position(val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/settings_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Data Removed");
      get_positions();
    } else {
      alert("error", "Fail to remove data!");
    }
  };
  xhar.send("rem_position=" + val);
}
// Function Calls
document.addEventListener("DOMContentLoaded", function () {
  get_general();
  get_positions();
});
