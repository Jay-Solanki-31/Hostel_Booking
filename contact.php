<?php


include "main_header.php";

include "config/UserController.php";
$UserController = new UserController();
$UserController->Contact();

?>





<!-- SUB BANNER -->
<section class="section-sub-banner bg-9">
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>CONTACT WITH US</h2>
            </div>
        </div>

    </div>

</section>
<!-- END / SUB BANNER -->

<!-- CONTACT -->
<section class="section-contact">
    <div class="container">
        <div class="contact">
            <div class="row">

                <div class="col-md-6 col-lg-5">

                    <div class="text">
                        <h2>Contact</h2>
                        <ul>
                            <li><i class="icon lotus-icon-location"></i>Anand,Gujarat </li>
                            <li><i class="icon lotus-icon-phone"></i> +91 22233 55661</li>
                        </ul>
                    </div>



                </div>

                <div class="col-md-6 col-lg-6 col-lg-offset-1">
                    <div class="contact-form">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="field-text" name="name" id="name" placeholder="Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="field-text" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" class="field-text" name="contactNo" id="contactNo" placeholder="ContactNo">
                                </div>
                                <div class="col-sm-12">
                                    <textarea cols="30" rows="10" name="message" class="field-textarea" placeholder="Write what do you want" id="message" ></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="awe-btn awe-btn-13">SEND</button>
                                </div>
                            </div>
                            <div id="contact-content"></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END / CONTACT -->



<?php include "main_footer.php" ?>