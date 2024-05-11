// password validation
function validatePass() {
  let passwords = document.querySelectorAll(".staff-pass, .staff-edit-pass");
  // console.log("Password inputs:", passwords); // Log password inputs for debugging
  let isValid = true;

  passwords.forEach((password) => {
    let passwordValue = password.value;
    // console.log("Password value:", passwordValue);
    if (passwordValue.trim() !== "") {
      // Regular expression for password validation
      let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
      if (!passwordRegex.test(passwordValue)) {
        isValid = false;
      }
    }
  });

  if (!isValid) {
    alert("error", "Follow the instruction.");
  }

  return isValid;
}
// phone
function validatePhoneNumber() {
  let phoneInputs = document.querySelectorAll(".staff_ph");
  let isValid = true;

  phoneInputs.forEach((input) => {
    let phoneValue = input.value;
    // console.log("Phone value:", phoneValue);
    // Check if the phone input is not empty
    if (phoneValue.trim() !== "") {
      // Regular expression for phone number validation
      let phonePattern = /^\+?\d{1,3}[- ]?\d{3,}$/;
      if (!phonePattern.test(phoneValue)) {
        isValid = false;
      }
    }
  });

  if (!isValid) {
    alert("Please enter a valid phone number.");
  }

  return isValid;
}

//////////////////////////////////////////////////////////////////////////////////
// Handle Data

let add_staff_form = document.getElementById("add_staff_form");

add_staff_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_staff();
});

function add_staff() {
  // Validate input fields
  if (!validatePhoneNumber() || !validatePass()) {
    return;
  }

  let data = new FormData();
  data.append("add_staff", "");
  data.append("StaffFullName", add_staff_form.elements["staff_name"].value);
  data.append("StaffNRC", add_staff_form.elements["NRC"].value);
  data.append("StaffDOB", add_staff_form.elements["dob"].value);
  data.append("StaffPhoneNo", add_staff_form.elements["phone"].value);
  data.append("Street", add_staff_form.elements["street"].value);
  data.append("Township", add_staff_form.elements["township"].value);
  data.append("City", add_staff_form.elements["city"].value);
  data.append("StaffEmail", add_staff_form.elements["email"].value);
  data.append("StaffPassword", add_staff_form.elements["staff-pass"].value);
  data.append("StaffConfirm", add_staff_form.elements["staff-confirm"].value);
  data.append("StaffPic", add_staff_form.elements["staff_pic"].files[0]);
  data.append("PositionNo", add_staff_form.elements["position"].value);

  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/team_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("add-staffs");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText.trim() == "pass_mismatch") {
      alert("error", "Password does not match!");
    } else if (this.responseText.trim() == "email_already") {
      alert("error", "Email is already registered!");
    } else if (this.responseText.trim() == "phone_already") {
      alert("error", "Phone Number is already registered!");
    } else if (this.responseText.trim() == "invalid_img") {
      alert("error", "Only JPG, JPEG, WEBP images are allowed!");
    } else if (this.responseText.trim() == "invalid_size") {
      alert("error", "Images should be less than 2MB!");
    } else if (this.responseText.trim() == "upload_failed") {
      alert("error", "Images upload failed. Server Down");
    } else {
      alert("success", "New Staff added successfully!");
      add_staff_form.reset();
      get_all_staff();
    }
  };
  xhar.send(data);
}

function get_all_staff() {
  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/team_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // When it's done, parse the results and call the callback function that was
  xhar.onload = function () {
    document.getElementById("staffs_data").innerHTML = this.responseText;
  };
  xhar.send("get_all_staff");
}

// edit Staff
let edit_staff_form = document.getElementById("edit_staff_form");

function edit_staff(StaffID) {
  // Set up the request
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/team_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    let data = JSON.parse(this.responseText);
    // console.log(JSON.parse(this.responseText));
    // console.log(data.staffdata.StaffPic);
    edit_staff_form.elements["staff_name"].value = data.staffdata.StaffFullName;
    edit_staff_form.elements["NRC"].value = data.staffdata.StaffNRC;
    edit_staff_form.elements["dob"].value = data.staffdata.StaffDOB;
    edit_staff_form.elements["phone"].value = data.staffdata.StaffPhoneNo;
    edit_staff_form.elements["street"].value = data.staffdata.Street;
    edit_staff_form.elements["township"].value = data.staffdata.Township;
    edit_staff_form.elements["city"].value = data.staffdata.City;
    edit_staff_form.elements["position"].value = data.staffdata.PositionNo;
    edit_staff_form.elements["email"].value = data.staffdata.StaffEmail;
    // edit_staff_form.elements["staff-edit-pass"].value =
    //   data.staffdata.StaffPassword;
    document.getElementById("staff_pic").src = data.staffdata.image_path;
    document.getElementById("edit_staff_id").value = StaffID;
  };
  xhar.send("get_staff=" + StaffID);
}

edit_staff_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_staff();
});

function submit_edit_staff() {
  // Validate input fields
  if (!validatePhoneNumber() || !validatePass()) {
    return;
  }

  // Create a new FormData object to store form data
  let data = new FormData();

  // Append form data to the FormData object
  data.append("edit_staff", "");
  data.append("StaffID", edit_staff_form.elements["StaffID"].value);
  data.append("StaffFullName", edit_staff_form.elements["staff_name"].value);
  data.append("StaffNRC", edit_staff_form.elements["NRC"].value);
  data.append("StaffDOB", edit_staff_form.elements["dob"].value);
  data.append("StaffPhoneNo", edit_staff_form.elements["phone"].value);
  data.append("Street", edit_staff_form.elements["street"].value);
  data.append("Township", edit_staff_form.elements["township"].value);
  data.append("City", edit_staff_form.elements["city"].value);
  data.append("PositionNo", edit_staff_form.elements["position"].value);
  data.append("StaffEmail", edit_staff_form.elements["email"].value);
  data.append(
    "StaffPassword",
    edit_staff_form.elements["staff-edit-pass"].value
  );
  data.append(
    "edit_staff_confirm",
    edit_staff_form.elements["staff-edit-confirm"].value
  );

  // Capture the source of the existing image
  let oldImgSrc = document.getElementById("staff_pic").src;
  // Extract the filename from the image source
  let oldImgFilename = oldImgSrc.substring(oldImgSrc.lastIndexOf("/") + 1);

  // Check if a new image is selected
  let staffPicInput = edit_staff_form.elements["staff_pic"];
  if (staffPicInput && staffPicInput.files.length > 0) {
    // If a new image is selected, append the file to FormData
    let staffPicFile = staffPicInput.files[0];
    data.append("StaffPic", staffPicFile);
  } else {
    // If no new image selected, append the existing image filename
    data.append("StaffPic", oldImgFilename);
  }
  let xhar = new XMLHttpRequest();
  // Configure the request: POST method, URL, asynchronous
  xhar.open("POST", "ajax/team_crud.php", true);

  xhar.onload = function () {
    var myModal = document.getElementById("edit-staff");
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == "pass_mismatch") {
      alert("error", "Password does not match!");
    } else if (this.responseText == "invalid_img") {
      alert("error", "Only JPG, JPEG, WEBP images are allowed!");
    } else if (this.responseText == "invalid_size") {
      alert("error", "Images should be less than 2MB!");
    } else if (this.responseText == "upload_failed") {
      alert("error", "Image upload failed. Server Down");
    } else if (this.responseText == "1") {
      alert("success", "Staff Data Updated");
      edit_staff_form.reset();
      get_all_staff();
    } else {
      alert("error", "No data changed");
    }
  };

  // Send the FormData object with the request
  xhar.send(data);
}

function rem_staff(val) {
  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/team_crud.php", true);
  xhar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhar.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Data Removed");
      get_all_staff();
    } else {
      alert("error", "Fail to remove data!");
    }
  };
  xhar.send("rem_staff=" + val);
}

// Function Calls

document.addEventListener("DOMContentLoaded", function () {
  get_all_staff();
});
