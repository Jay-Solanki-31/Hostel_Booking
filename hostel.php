<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelData = $UserController->get_hostel();
?>

<section class="section-sub-banner bg-9">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>HOSTELS &amp; INFO </h2>
            </div>
        </div>
    </div>
</section>

<section class="section-room bg-white">
    <div class="container">
        <div class="room-wrap-5">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row" id="hostelList">
                        <?php foreach ($hostelData as $hostel) : ?>
                            <div class="col-xs-12 col-md-6">
                                <div class="room_item-5" data-background='uploads/hostels/<?php echo $hostel->image; ?>'>

                                    <!-- Display hostel image -->
                                    <div class="img">
                                        <a href="#"><img src="uploads/hostels/<?php echo $hostel->image; ?>" alt=""></a>
                                    </div>

                                    <!-- Display hostel name -->
                                    <div class="room_item-forward">
                                        <h2><a href="hostel-detail.php?id=<?php echo $hostel->id; ?>"><?php echo $hostel->hostel_name; ?></a></h2>
                                    </div>

                                    <!-- Display hostel description and location -->
                                    <div class="room_item-back">
                                        <h3><?php echo $hostel->hostel_name; ?></h3>
                                        <p><?php echo $hostel->description; ?></p>
                                        <p><?php echo $hostel->location; ?></p>
                                        <a href="hostel-detail.php?id=<?php echo $hostel->id; ?>" class="awe-btn awe-btn-13">VIEW DETAILS</a>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="room-detail_book">
                        <div class="room-detail_total">
                            <img src="images/icon-logo.png" alt="" class="icon-logo">
                            <h5>Filter Hostels</h5>
                        </div>

                        <div class="room-detail_form">
                            <label>City Name</label>
                            <input type="text" id="citySearch" class="awe-select" placeholder="Enter city name">

                            <label>Hostel Name</label>
                            <input type="text" id="hostelSearch" class="awe-select" placeholder="Enter Hostel name">

                            <button id="filterButton" class="awe-btn awe-btn-13">Filter</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<?php include "main_footer.php" ?>

