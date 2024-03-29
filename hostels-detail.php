<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}
include "main_header.php";
include "config/UserController.php";

if (isset($_GET['id'])) {
    $hostelId = $_GET['id'];
}

$UserController = new UserController();
$hostelData = $UserController->get_hostel($hostelId);
$UserController->AddInquery($hostelId);
?>
<style>
    .bold-medium {
        font-weight: bold;
        font-size: xx-large;
        /* You can adjust the size as needed */
    }

    .room-detail {
    margin-top: 40px;
}
</style>



<section class="section-sub-banner bg-16">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <!-- Display Hostel Name -->
                <?php foreach ($hostelData as $hostel) {
                    if ($hostel->id == $hostelId) {
                        echo "<h2>{$hostel->hostel_name}</h2>";
                        break;
                    }
                } ?>
            </div>
        </div>
    </div>
</section>
<!-- END / SUB BANNER -->


<!-- ROOM DETAIL -->
<section class="section-room-detail bg-white">
    <div class="container">
        <div class="room-wrap-5">

            <!-- DETAIL -->
            <div class="room-detail">
                <div class="row">
                    <div class="col-lg-9">
                        <!-- LAGER IMGAE -->
                        <div class="room-detail_img">
                            <?php foreach ($hostelData as $hostel) {
                                if ($hostel->id == $hostelId) { ?>
                                    <div class="room_img-item">
                                        <img src="uploads/hostels/<?php echo $hostel->image; ?>" alt="">
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <!-- END / LAGER IMGAE -->


                    </div>

                    <div class="col-lg-3">

                        <!-- FORM BOOK -->
                        <div class="room-detail_book">

                            <div class="room-detail_total">
                                <img src="images/icon-logo.png" alt="" class="icon-logo">
                                <h5>Enquiry Now </h5>
                            </div>

                            <form action="" id="inquery" method="post">
                                <div class="room-detail_form">
                                    <input type="hidden" name="hostel_id" value="<?php echo $hostelId; ?>">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name ">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                                    <label>Phone No </label>
                                    <input type="text" name="contactNo" id="contactNo" class="form-control" placeholder="Enter Your Contact No">
                                    <label>Description</label>
                                    <input type="text" name="message" id="message" class="form-control" placeholder="Enter Your Desciption">
                                    <button class="awe-btn awe-btn-13">enquiry Now</button>
                                </div>
                            </form>


                        </div>
                        <!-- END / FORM BOOK -->

                    </div>
                </div>
            </div>
            <!-- END / DETAIL -->

            <!-- TAB -->
            <div class="room-detail_tab">

                <div class="row">
                    <div class="col-md-3">
                        <ul class="room-detail_tab-header">
                            <li class="active"><a href="#overview" data-toggle="tab">OVERVIEW</a></li>
                            <li><a href="#amenities" data-toggle="tab">AMENITIES</a></li>
                            <li><a href="#location" data-toggle="tab">LOCATION</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- OVERVIEW -->
                            <div class="tab-pane fade active in" id="overview">
                                <?php foreach ($hostelData as $hostel) {
                                    if ($hostel->id == $hostelId) { ?>
                                        <div class="room-detail_overview">
                                            <p class="bold-medium"><?php echo $hostel->description; ?></p>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <!-- END / OVERVIEW -->



                            <!-- AMENITIES -->
                            <div class="tab-pane fade" id="amenities">
                                <div class="room-detail_amenities">
                                    <?php foreach ($hostelData as $hostel) {
                                        if ($hostel->id == $hostelId) { ?>
                                            <div class="room-detail_overview">
                                                <!-- amenities -->
                                                <div class="row">
                                                    <?php
                                                    $amenitiesArray = explode(",", $hostel->amenities);

                                                    foreach (NORMAL_AMENITIES as $normalAmenity) {
                                                        if (in_array($normalAmenity['value'], $amenitiesArray)) {
                                                            echo '<div class="col-xs-6 col-lg-4">
                <h6 style="font-weight: unset;">' . $normalAmenity['name'] . '</h6>
              </div>';
                                                        }
                                                    }

                                                    foreach (PREMIUM_AMENITIES as $preAmenity) {
                                                        if (in_array($preAmenity['value'], $amenitiesArray)) {
                                                            echo '<div class="col-xs-6 col-lg-4">
                <h6 style="font-weight: unset;">' . $preAmenity['name'] . '</h6>
              </div>';
                                                        }
                                                    }


                                                    ?>
                                                </div>
                                                <!-- End amenities -->
                                            </div>
                                    <?php }
                                    } ?>
                                </div>

                            </div>
                            <!-- END / AMENITIES -->

                            <!-- location -->
                            <div class="tab-pane fade" id="location">

                                <?php foreach ($hostelData as $hostel) {
                                    if ($hostel->id == $hostelId) { ?>
                                        <div class="room-detail_overview">

                                            <?php echo $hostel->location; ?>
                                        </div>
                                <?php }
                                } ?>

                            </div>
                            <!-- END / location -->


                        </div>
                    </div>

                </div>

            </div>
            <!-- END / TAB -->


        </div>
</section>

<?php include "main_footer.php" ?>