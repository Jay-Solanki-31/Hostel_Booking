<?php
session_start();

if (isset($_SESSION['user_email'])) {
    header("Location: index.php"); 
    exit();
}

include "main_header.php";
include "config/UserController.php";

$UserController = new UserController();
$UserController->UserRegister();

?>

<!-- ACCOUNT -->
<section class="section-account parallax bg-11">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="login-register">
            <div class="text text-center">
                <h2>REGISTER FORM</h2>
                <form id="account_form" action="" method="POST" class="account_form">
                    <div class="field-form">
                        <select name="account_type" id="account_type" class="field-text">
                            <option value="" selected disabled>Select Account Type*</option>
                            <option value="hostel" style="color:black">Hostel</option>
                            <option value="student" style="color:black">Student</option>
                        </select>
                    </div>
                    <div class="field-form">
                        <input id="username" name="username" type="text" class="field-text" placeholder="User name*">
                    </div>
                    <div class="field-form">
                        <input id="email" name="email" type="text" class="field-text" placeholder="Email*">
                    </div>
                    <div class="field-form">
                        <input id="password" name="password" type="password" class="field-text" placeholder="Password*">
                        <span class="view-pass"><i class="lotus-icon-view"></i></span>
                    </div>
                    <div class="field-form">
                        <input id="contact_no" name="contact_no" type="text" class="field-text" placeholder="Contact No">
                    </div>
                    <div class="field-form field-submit">
                        <button id="register_btn" class="awe-btn awe-btn-13">REGISTER</button>
                    </div>
                    <span style= " font-size:medium; font-family:bolt; color:black;"   class="account-desc">I have account - <a href="login.php">Login  Account</a></span>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- END / ACCOUNT -->

<?php include "main_footer.php" ?> 

