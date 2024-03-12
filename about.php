<?php 

    
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$AboutUs = $UserController->showAboutUsData();

?>        
      <!-- SUB BANNER -->
<section class="section-sub-banner bg-9">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>ABOUT Us</h2>
            </div>
        </div>
    </div>
</section>
<!-- END / SUB BANNER -->

<!-- ABOUT -->
<section class="section-about">
    <div class="container">
        <div class="about">
            <?php foreach ($AboutUs as $aboutItem): ?>
                <div class="about-item">
                    <div class="img owl-single">
                        <img src="uploads/about-us/<?php echo $aboutItem->picture; ?>" alt="">
                    </div>
                    <div class="text">
                         <div class="desc">
                            <p><?php echo $aboutItem->info; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- END / ABOUT -->

<?php include "main_footer.php" ?>
