<?php 

include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();

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
                                <input type="password" id="new_password" name="new_password" class="field-text" placeholder="New Password">
                                <span class="view-pass"><i class="lotus-icon-view"></i></span>
                            </div>
                            <div class="field-form">
                                <input type="password" id="confirm_password" name="confirm_password" class="field-text" placeholder="Confirm New Password">
                                <span class="view-pass"><i class="lotus-icon-view"></i></span>
                            </div>
                            <div class="field-form field-submit">
                                <button class="awe-btn awe-btn-13">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- END / ACCOUNT -->
<?php include "main_footer.php" ?>