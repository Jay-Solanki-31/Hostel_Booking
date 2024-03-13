<?php 
session_start();

if (isset($_SESSION['user_email'])) {
    header("Location: index.php"); 
}


include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$UserController->Userlogin();

?>
        <!-- ACCOUNT -->
        <section class="section-account parallax bg-11">
            <div class="awe-overlay"></div>
            <div class="container">
                <div class="login-register">
                    <div class="text text-center">
                        <h2>LOGIN ACCOUNT</h2>
                     <form action="" method="post" id="loginForm" class="account_form">
                            <div class="field-form">
                                <input type="text" class="field-text" id=email name="email" placeholder="Email">
                            </div>
                            <div class="field-form">
                                <input type="password" id="password" name="password" class="field-text" placeholder="Password">
                                <span class="view-pass"><i class="lotus-icon-view"></i></span>
                            </div>
                            <div class="field-form field-submit">
                                <button class="awe-btn awe-btn-13">Login</button>
                            </div>
                            <span class="account-desc">I don’t remember my Password - <a href="forgot_password.php">Forgot Password</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- END / ACCOUNT -->
<?php include "main_footer.php" ?>