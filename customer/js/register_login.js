// Age Restriction

function calculateAge(dob) {
  let currentDate = new Date();
  let age = currentDate.getFullYear() - dob.getFullYear();
  if (
    currentDate.getMonth() < dob.getMonth() ||
    (currentDate.getMonth() === dob.getMonth() &&
      currentDate.getDate() < dob.getDate())
  ) {
    age--;
  }
  return age;
}

// Function to handle input change event
function handleInputChange() {
  let dobInput = document.getElementById("dob");
  let dob = new Date(dobInput.value);
  let age = calculateAge(dob);

  if (age <= 18) {
    alert("error", "Sorry, you must be at least 18 years old.");
    return false;
  } else {
    return true;
  }
}

function validatePhoneNumber() {
  let phoneNumber = document.getElementById("c-ph").value;
  // Regular expression to validate phone numbers with optional country code
  let phonePattern = /^\+?\d{1,3}[- ]?\d{3,}$/;
  if (!phonePattern.test(phoneNumber)) {
    alert("error", "Please enter a valid phone number.");
    return false; // to prevent form submission
  }
  return true; // to allow form submission
}
// password validation
function validatePass() {
  let password = document.getElementById("pass").value;
  // Regular expression for password validation
  let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
  if (!passwordRegex.test(password)) {
    alert("error", "Follow the intruction.");
    return false; // to prevent form submission
  }
  return true; // to allow form submission
}

//////////////////////////////////////////////////////////////////////////////////
// Handle Data

let register_form = document.getElementById("C-Register-Form");

register_form.addEventListener("submit", function (e) {
  e.preventDefault();
  register_customer();
});
function register_customer() {
  // Validate input fields
  if (!handleInputChange() || !validatePhoneNumber() || !validatePass()) {
    return;
  }

  let passportNo = register_form.elements["c-passport"].value;
  let nrc = register_form.elements["c-nrc"].value;

  if (!passportNo && !nrc) {
    alert("error", "Please insert either Passport Number or NRC.");
    return;
  }

  //add customer
  let data = new FormData();
  data.append("register", "");
  data.append("name", register_form.elements["c-name"].value);
  data.append("gender", register_form.elements["c-gender"].value);
  data.append("email", register_form.elements["c-email"].value);
  data.append("ph", register_form.elements["c-ph"].value);
  data.append("dob", register_form.elements["c-dob"].value);
  data.append("NRC", register_form.elements["c-nrc"].value);
  data.append("passport", register_form.elements["c-passport"].value);
  data.append("street", register_form.elements["c-street"].value);
  data.append("town", register_form.elements["c-town"].value);
  data.append("city", register_form.elements["c-city"].value);
  data.append("country", register_form.elements["c-country"].value);
  data.append("postal", register_form.elements["c-postal"].value);
  data.append("pic", register_form.elements["c-pic"].files[0]);
  data.append("pass", register_form.elements["c-pass"].value);
  data.append("confirm", register_form.elements["c-confirm"].value);

  var myModal = document.getElementById("regModal");
  var modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/login_register.php", true);

  xhar.onload = function () {
    if (this.responseText.trim() == "pass_mismatch") {
      alert("error", "Password does not match!");
    } else if (this.responseText.trim() == "email_already") {
      alert("error", "Email is already registered!");
    } else if (this.responseText.trim() == "phone_already") {
      alert("error", "Phone Number is already registered!");
    } else if (this.responseText.trim() == "nrc_already") {
      alert("error", "NRC is already registered!");
    } else if (this.responseText.trim() == "passport_already") {
      alert("error", "Passport No is already registered!");
    } else if (this.responseText.trim() == "invalid_img") {
      alert("error", "Only JPG, JPEG, WEBP images are allowed!");
    } else if (this.responseText.trim() == "upload_failed") {
      alert("error", "Image upload failed!");
    } else if (this.responseText.trim() == "mail_failed") {
      alert(
        "error",
        "Cannot send confirmation email! Server Down! Please Contact Admin!"
      );
    } else if (this.responseText.trim() == "ins_failed") {
      alert("error", "Registration Failed! Server Down! Please Contact Admin!");
    } else {
      alert(
        "success",
        "Registration Successful. Check your Email for Confirmation."
      );
      register_form.reset();
    }
  };
  xhar.send(data);
}
// login form
let login_form = document.getElementById("C-Login-Form");

login_form.addEventListener("submit", function (e) {
  e.preventDefault();

  login_customer();
});
function login_customer() {
  let data = new FormData();
  data.append("c_login", "");
  data.append("email_mob", login_form.elements["email_mob"].value);
  data.append("login_pass", login_form.elements["c-login-pass"].value);

  var myModal = document.getElementById("loginModal");
  var modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/login_register.php", true);

  xhar.onload = function () {
    if (this.responseText == "inv_email_mob") {
      alert("error", "Invalid email or phone number!");
    } else if (this.responseText == "not_verified") {
      alert("error", "Email is not verified!");
    } else if (this.responseText == "inactive") {
      alert("error", "Account Suspended! Please contact Admin.");
    } else if (this.responseText == "invalid_pass") {
      alert("error", "Incorrect Password!");
    } else {
      let fileurl = window.location.href.split("/").pop().split("?").shift();
      if (fileurl == "confirm_booking.php") {
        window.location = window.location.href;
      } else {
        window.location = window.location.pathname;
      }
    }
  };
  xhar.send(data);
}
// forgot password form
let forgot_form = document.getElementById("Forgot-Form");

forgot_form.addEventListener("submit", function (e) {
  e.preventDefault();

  forgot_pass();
});
function forgot_pass() {
  let data = new FormData();
  data.append("forgot_pass", "");
  data.append("forgot_email", forgot_form.elements["forgot-email"].value);

  var myModal = document.getElementById("forgotModal");
  var modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhar = new XMLHttpRequest();
  xhar.open("POST", "ajax/login_register.php", true);

  xhar.onprogress = function () {};

  xhar.onload = function () {
    if (this.responseText == "inv_email") {
      alert("error", "Invalid email!");
    } else if (this.responseText == "not_verified") {
      alert("error", "Email is not verified!Please contact Admin.");
    } else if (this.responseText == "inactive") {
      alert("error", "Account Suspended! Please contact Admin.");
    } else if (this.responseText == "mail_failed") {
      alert("error", "Cannot send email to reset Password!");
    } else if (this.responseText == "upd_failed") {
      alert("error", "Password recovery failed!Server Down!");
    } else {
      alert("success", "Reset link send to email! Please check your email!");
      forgot_form.reset();
    }
  };
  xhar.send(data);
}
