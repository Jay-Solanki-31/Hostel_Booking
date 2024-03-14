<?php
session_start();
function isLoggedIn()
{
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
include "main_header.php";
include "config/UserController.php";

if (isset($_GET['id'])) {
    $hostelId = $_GET['id'];
}

$UserController = new UserController();
$hostelData = $UserController->get_hostel($hostelId);
?>

    <!-- SUB BANNER -->
    <section class="section-sub-banner bg-16">
        <div class="awe-overlay"></div>
        <div class="sub-banner">
            <div class="container">
                <div class="text text-center">
                    <h2>LUXURY ROOM</h2>
                    <p>Lorem Ipsum is simply dummy text</p>
                </div>
            </div>

        </div>

    </section>
    <!-- END / SUB BANNER -->

    <!-- ROOM DETAIL -->
    <section class="section-room-detail bg-white">
        <div class="container">

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

                                <h6>STARTING ROOM FROM</h6>

                                <p class="price">
                                    <span class="amout">$260</span> /days
                                </p>
                            </div>

                            <div class="room-detail_form">
                                <label>Name</label>
                                <input type="text" class="text" placeholder="Enter Your Name ">
                                <label>Email</label>
                                <input type="email" placeholder="Enter your Email">
                                <label>Phone No </label>
                                <input type="text" placeholder="Enter Your Contact No">
                                <label>Description</label>
                                <input type="text" placeholder="Enter Your Desciption">
                                <button class="awe-btn awe-btn-13">Inquery Now</button>
                            </div>

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
                            <ul class="room-detail_tab-header">
                                <li class="active"><a href="#overview" data-toggle="tab">OVERVIEW</a></li>
                                <li><a href="#amenities" data-toggle="tab">AMENITIES</a></li>
                                <li><a href="#location" data-toggle="tab">LOCATION</a></li>
                            </ul>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- OVERVIEW -->
                            <div class="tab-pane fade" id="overview">

                                <div class="tab-pane fade active in" id="overview">
                                    <?php foreach ($hostelData as $hostel) {
                                        if ($hostel->id == $hostelId) { ?>
                                            <div class="room-detail_overview">

                                                <?php echo $hostel->description; ?>
                                            </div>
                                    <?php }
                                    } ?>

                                </div>

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
                                                    foreach ($amenitiesArray as $amenity) { ?>
                                                        <div class="col-xs-6 col-lg-4">
                                                            <h6 style="font-weight: unset;"><?php echo trim($amenity); ?></h6>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <!-- End amenities -->
                                            </div>
                                    <?php }
                                    } ?>

                                </div>

                            </div>
                            <!-- END / AMENITIES -->

                            <!-- PACKAGE -->
                            <div class="tab-pane fade" id="package">

                                <div class="room-detail_package">

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
    <!-- END / SHOP DETAIL -->

<?php include "main_footer.php" ?>