<?php
require('./files/db_config.php');
require('./files/essentials.php');
date_default_timezone_set("Asia/Yangon");

session_start();

if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('dashboard.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('./files/a_links.php') ?>
</head>
<body>
<div class="login-form text-center rounded modal-bg shadow overflow-hidden">
    <form method="POST">
        <h4 class="py-3">ADMIN LOGIN PANEL</h4>
        <div class="p-4">
            <div class="mb-3">
                <input name="admin_name" type="text" class="form-control shadow-none text-center"
                       placeholder="Admin Name or Email" required>
            </div>
            <div class="mb-4">
                <div class="pass-container d-flex">
                    <input type="password" name="admin_pass" class="form-control shadow-none admin_pass" id="admin_pass" required>
                    <div class="show-pass_container">
                        <span class="show-pass">
                            <i class="bi bi-eye-slash toggle-pass" data-target="admin_pass"></i>
                        </span>
                    </div>
                </div>
                <!-- <input name="admin_pass" type="password" class="form-control shadow-none text-center"
                       placeholder="Password" required> -->
            </div>
            <button name="login" type="submit"
                    class="btn btn-color2 text-dark custom-bg shadow">LOGIN
            </button>

        </div>
    </form>
</div>
<?php
if (isset($_POST['login'])) {
    $frm_data = filtration($_POST);

    $query = "SELECT * FROM `staff` WHERE `StaffFullName` = ? OR `StaffEmail` = ? LIMIT 1";
    $values = [$frm_data['admin_name'], $frm_data['admin_name']];

    $res = select($query, $values, 'ss');

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        $stored_password_hash = $row['StaffPassword'];

        // Verify password using password_verify()
        if (password_verify(trim($frm_data['admin_pass']), $stored_password_hash)) {
            // Password is correct
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminID'] = $row['StaffID'];
            $_SESSION['positionNo'] = $row['PositionNo'];
            redirect('dashboard.php');
        } else {
            // Password is incorrect
            Alert('error', 'Login failed - Wrong Username or Password!');
        }
    } else {
        // User not found
        Alert('error', 'Login failed - User Not Found!');
    }
}

?>
<!-- footer -->
<?php require('./files/a_footer.php') ?>
</body>
</html>
