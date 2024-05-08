<?php

session_start();
function isLoggedIn()
{
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$hosteldata = $UserController->get_hostel()
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
                        if (!empty($hosteldata)) {
                            // Sort the array in descending order based on the hostel ID
                            usort($hosteldata, function ($a, $b) {
                                return $b->id - $a->id;
                            });

                            // Variable to hold all the first images
                            $firstImages = [];

                            foreach ($hosteldata as $hostel) {
                                // Get the first image of each hostel
                                $firstImage = 'uploads/hostels/' . explode(',', $hostel->image)[0];
                                // Add the first image to the array
                                $firstImages[] = $firstImage;
                            }
                            // Output all the first images in a single <img> tag
                            echo '<img src="' . implode(',', $firstImages) . '" alt="">';

                            foreach ($hosteldata as $hostel) :
                        ?>
                                <div class="col-xs-6">
                                    <div class="room_item-5" data-background='uploads/hostels/<?php echo $hostel->image; ?>'>

                                        <!-- Display hostel image -->
                                        <div class="img">
                                            <a href="#"><img src="uploads/hostels/<?php echo explode(',', $hostel->image)[0]; ?>" alt=""></a>
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
                    <form id="filterForm" action="filter_hostels.php" method="post">
                        <div class="room-detail_form">
                            <label>Hostel Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Filter by  Hostel Name">
                            <label>City</label>
                            <input type="text" name="city_name" id="city_name" class="form-control" placeholder="Filter by  City Name">
                            <button type="submit" class="awe-btn awe-btn-13">Filter Now</button>
                        </div>
                    </form>
                </div>
                <!-- END / FORM BOOK -->
            </div>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#filterForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $('#hostelList').empty();
                        $.each(response, function(index, hostel) {
                            var hostelHtml = `
                            <div class="col-xs-6">
                                <div class="room_item-5" data-background='uploads/hostels/${hostel.image}'>

                                    <!-- Display hostel image -->
                                    <div class="img">
                                        <a href="#"><img src="uploads/hostels/${hostel.image}" alt=""></a>
                                    </div>

                                    <!-- Display hostel name -->
                                    <div class="room_item-forward">
                                        <h2><a href="hostels-detail.php">${hostel.hostel_name}</a></h2>
                                    </div>

                                    <!-- Display hostel description and location -->
                                    <div class="room_item-back">
                                        <h3>
                                            <i class="fas fa-map-marker-alt"></i> ${hostel.location}
                                        </h3>
                                        <p>
                                            <i class="fas fa-info-circle"></i> ${hostel.description.substring(0, 100)}
                                            ${hostel.description.length > 100 ? '...' : ''}
                                        </p>
                                        <div class="button-container">
                                            <a href="hostels-detail.php?id=${hostel.id}" class="awe-btn awe-btn-13">VIEW DETAILS</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        `;
                            $('#hostelList').append(hostelHtml);
                            $('.room_item-6, .room_item-5').each(function(index, el) {
                                var $this = $(this),
                                    link_src = $this.data().background;

                                if (link_src != undefined && link_src != '') {
                                    $this.css('background-image', 'url(' + link_src + ')');
                                }
                            });

                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
    });
</script>



<?php include "main_footer.php" ?>