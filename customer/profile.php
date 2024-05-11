<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUNA</title>
    <?php require('./files/links.php') ?>

</head>
<body>
<!-- Header links -->
<?php require('files/header.php');
if(!isset($_SESSION['c_login']) && $_SESSION['c_login'] == true) {
    redirect('index.php');
}
$u_exist = select("SELECT * FROM `customer` WHERE `CustomerID`=? LIMIT 1",[$_SESSION['uId']],'i');

if (mysqli_num_rows($u_exist)==0) {
    redirect('index.php');
}

$u_fetch = mysqli_fetch_assoc( $u_exist );
?>

    
<!-- Main section start -->
<main id="c-main">
    <h2 class="main-title text-center text-uppercase m_top gs_reveal ">Profile</h2>
    <div class="h-line s-line"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5 px-4">
                <div class="container-bg p-3 p-md-4 rounded shadow-sm">
                    <form id="personal-info-form" >
                        <h5 class="mb-3 fw-bold">Personal Information</h5>
                        <div class="row">
                            
                                <div class="col-12 col-md-4  mb-3 ">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="p_name" value="<?php echo $u_fetch['CustomerFullName'] ?>" class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="p_dob" value="<?php echo $u_fetch['CustomerDOB'] ?>"  class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Phone No</label>
                                    <input type="number" name="p_ph" value="<?php echo $u_fetch['CustomerPhoneNo'] ?>"  class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="p_email" value="<?php echo $u_fetch['CustomerEmail'] ?>" class="form-control shadow-none" required >
                                </div>
                                
                                
                                
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" name="p_postal" value="<?php echo $u_fetch['PostalCode'] ?>" class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Street</label>
                                    <input type="text" name="p_street" value="<?php echo $u_fetch['Street'] ?>" class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">Township</label>
                                    <input type="text" name="p_town" value="<?php echo $u_fetch['Township'] ?>" class="form-control shadow-none" required >
                                </div>
                                <div class="col-12 col-md-4 mb-3 ">
                                    <label class="form-label">City</label>
                                    <input type="text" name="p_city" value="<?php echo $u_fetch['City'] ?>"  class="form-control shadow-none" required >
                                </div>
                                <div class="col-12  col-md-4 mb-3 ">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="p_country" value="<?php echo $u_fetch['Country'] ?>" class="form-control shadow-none" required >
                                </div>
                            
                            
                        </div>
                        <div class="col-12 p-3 text-end w-100">

                            <button type="submit" class="btn btn-color2 shadow-none">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-5 px-4">
                <div class="container-bg p-3 p-md-4 rounded shadow-sm gs_reveal gs_reveal_fromLeft">
                    <form id="profile-form" enctype="multipart/form-data">
                        <h5 class="mb-3 fw-bold">Picture</h5>
                        <div class="d-flex justify-content-center">
                            <img src="<?php echo CUSTOMER_IMG_PATH.$u_fetch['ProfilePic'] ?>" alt="Profile Pic" class=" img-fluid mb-3" style="width: 200px; height: 350px;">
                        </div>
                        <br>
                        <label class="form-label">New Picture</label>
                        <input type="file" name="profile" class="form-control shadow-none" accept=".jpg, .jpeg, .png, .webp" required>
                        <button type="submit" class="btn btn-color2 w-100 shadow-none mt-3">Save Changes</button>
                    </form>
                </div>
            </div>
        <div class="col-12 col-md-8 mb-5 px-4"> 
            <div class="container-bg p-3 p-md-4 rounded shadow-sm gs_reveal gs_reveal_fromRight">
                <form id="pass-form">
                    <h5 class="mb-3 fw-bold">Change Password</h5>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">New Password</label>
                            <div class="pass-container d-flex">
                                <input type="password" name="new_pass" class="form-control shadow-none new_pass" id="new_pass" required>
                                <div class="show-pass_container">
                                    <span class="show-pass">
                                        <i class="bi bi-eye-slash toggle-pass" data-target="new_pass"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <div class="pass-container d-flex">
                                <input type="password" name="confirm_pass" class="form-control shadow-none c-confirm" id="confirm_pass" required>
                                <div class="show-pass_container">
                                    <span class="show-pass">
                                        <i class="bi bi-eye-slash toggle-pass" data-target="confirm_pass"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="p-note col-12">*Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase, and one lowercase letter.</span>
                    </div>
                    <div class="col-12 p-3 text-end w-100">

                        <button type="submit" class="btn btn-color2 shadow-none">Change</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    
</main>
<?php require('./chatbot.php');?>    
<!-- Main section end -->
<!-- scroll up -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bi bi-arrow-up-square"></i>
    </a>


<!-- footer -->
<?php require('files/footer.php');?>






<script>
    let personal_info_form = document.getElementById("personal-info-form");

    personal_info_form.addEventListener('submit',function(e){
        e.preventDefault();

        get_profile();

    })
    function get_profile(){
        let data = new FormData();
        data.append("personal_info_form", "");
        data.append("name", personal_info_form.elements['p_name'].value);
        data.append("dob", personal_info_form.elements['p_dob'].value);
        data.append("ph", personal_info_form.elements['p_ph'].value);
        data.append("email", personal_info_form.elements['p_email'].value);
       
        data.append("postalcode", personal_info_form.elements['p_postal'].value);
        data.append("street", personal_info_form.elements['p_street'].value);
        data.append("town", personal_info_form.elements['p_town'].value);
        data.append("city", personal_info_form.elements['p_city'].value);
        data.append("country", personal_info_form.elements['p_country'].value);
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile_fetch.php", true);
            

            xhr.onload = function () {
                if (this.responseText == "email_already") {
                    alert("error", "Email is already registered!");
                } else if (this.responseText == "phone_already") {
                alert("error", "Phone Number is already registered!");
                } else if(this.responseText == 0){
                alert("error", "No Changes Made!");
                }else{
                    alert("success", "Changes Saved!");
                };
            }
            xhr.send(data);
    }

    let profile_form =document.getElementById("profile-form");
    profile_form.addEventListener('submit',function(e){
        e.preventDefault();

        update_profile();

    })
function update_profile(){
    let data = new FormData();
        data.append("profile_form", "");
        data.append("profile", profile_form.elements['profile'].files[0]);
        
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile_fetch.php", true);

            xhr.onload = function () {
                if (this.responseText == "invalid_img") {
                alert("error", "Only JPG,WEBP & PNG images are allowed!");
                } else if (this.responseText == "upload_failed") {
                alert("error", "Image upload failed!");
                } else if(this.responseText == 0){
                alert("error", "Update Failed!");
                }else{
                    window.location.href = window.location.pathname;
                };
            }
            xhr.send(data);
}

    // password validation
    function validatePass() {
    let password = document.getElementById("new_pass").value;
    // Regular expression for password validation
    let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if (!passwordRegex.test(password)) {
        alert("error", "Follow the intruction.");
        return false; // to prevent form submission
    }
    return true; // to allow form submission
    }

    let pass_form = document.getElementById("pass-form");
    pass_form.addEventListener('submit',function(e){
        e.preventDefault();

        update_pass();

    })
    function update_pass(){
        let new_pass =pass_form.elements['new_pass'].value;
        let confirm_pass =pass_form.elements['confirm_pass'].value;

        if (new_pass!=confirm_pass) {
            alert('error','Password do not match');
            return false;
        }
        if (!validatePass()) {return;}
            
        
        let data = new FormData();
        data.append("pass_form", "");
        data.append("new_pass", new_pass);
        data.append("confirm_pass", confirm_pass);
        
        
        let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/profile_fetch.php", true);

            xhr.onload = function () {
                if (this.responseText == "mismatch") {
                alert("error", "Password do not match!");
                } else if(this.responseText == 0){
                alert("error", "Update Failed!");
                }else{
                    alert('success','Password Changed!')
                    pass_form.reset();
                };
            }
            xhr.send(data);
    }

</script>








</body>
</html>