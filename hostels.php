<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}

include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();


?>

<section class="section-sub-banner bg-9">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>FIND HOSTELS</h2>
            </div>
        </div>
    </div>
</section>

<style>
    .room-detail_book {
        margin-top: 0px;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }
</style>

<section class="section-room bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="room-wrap-5">
                    <div class="row" id="hostelList">
                        <?php
                        // Check if there's any data to display
                        if (!empty($hostelData)) {
                            foreach ($hostelData as $hostel) :
                        ?>
                                <div class="col-xs-6">
                                    <div class="room_item-5" data-background='uploads/hostels/<?php echo $hostel->image; ?>'>

                                        <!-- Display hostel image -->
                                        <div class="img">
                                            <a href="#"><img src="uploads/hostels/<?php echo $hostel->image; ?>" alt=""></a>
                                        </div>

                                        <!-- Display hostel name -->
                                        <div class="room_item-forward">
                                            <h2><a href="hostels-detail.php"><?php echo $hostel->hostel_name; ?></a></h2>
                                        </div>

                                        <!-- Display hostel description and location -->
                                        <div class="room_item-back">
                                            <h3>
                                                <i class="fas fa-map-marker-alt"></i> <?php echo $hostel->location; ?>
                                            </h3>
                                            <p>
                                                <i class="fas fa-info-circle"></i>
                                                <?php
                                                $description = $hostel->description;
                                                $trimmed_description = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                                                echo $trimmed_description;
                                                ?>
                                            </p>
                                            <div class="button-container">
                                                <a href="hostels-detail.php?id=<?php echo $hostel->id; ?>" class="awe-btn awe-btn-13">VIEW DETAILS</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        <?php
                            endforeach;
                        } else {
                            // Display message if no hostels found or no data submitted
                            echo '<div class="col-xs-12"><p>' . ($no_data_message ? $no_data_message : "No data submitted.") . '</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- FORM BOOK -->
                <div class="room-detail_book">
                    <div class="room-detail_total">
                        <img src="images/icon-logo.png" alt="" class="icon-logo">
                        <h5>Filter Hostels </h5>
                    </div>
                    <form action="" method="post">
                        <div class="room-detail_form">
                            <label>Hostels Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Hostels Name">
                            <label>City</label>
                            <input type="text" name="city_name" id="city_name" class="form-control" placeholder="Enter City Name">
                            <button type="submit" class="awe-btn awe-btn-13">Filter Now</button>
                        </div>
                    </form>
                </div>
                <!-- END / FORM BOOK -->
            </div>
        </div>
    </div>
</section>

<?php include "main_footer.php" ?>
