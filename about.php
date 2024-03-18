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
            <?php foreach (array_slice($AboutUs, 0, 1) as $aboutItem) : ?>
                <!-- ITEM -->
                <div class="about-item">
                    <div class="img owl-single">
                        <img src="uploads/about-us/<?php echo $aboutItem->picture; ?>" alt="">
                    </div>
                    <div class="text">
                        <h2 class="heading"><?php  echo $aboutItem->heading; ?></h2>
                        <div class="desc">
                            <p><?php echo $aboutItem->info; ?></p>
                        </div>
                    </div>
                </div>
                <!-- END / ITEM -->
            <?php endforeach; ?>

            <?php
            $counter = 0;
            foreach ($AboutUs as $aboutItem) :
                $counter++;
                if ($counter == 2) :
            ?>
                    <!-- ITEM -->
                    <div class="about-item about-right">
                        <div class="img">
                            <img src="uploads/about-us/<?php echo $aboutItem->picture; ?>" alt="">
                        </div>
                        <div class="text">
                            <h2 class="heading"><?php echo $aboutItem->heading; ?></h2>
                            <p><?php echo $aboutItem->info; ?></p>
                        </div>
                    </div>
                    <!-- END / ITEM -->
            <?php
                endif;
            endforeach;
            ?>
        </div>

    </div>
</section>
<!-- END / ABOUT -->

<?php include "main_footer.php" ?>