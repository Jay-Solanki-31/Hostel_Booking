<?php
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
                                        <a href="room-detail.php?id=<?php echo $hostel->id; ?>" class="awe-btn awe-btn-13">VIEW DETAILS</a>
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

<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        var cityInput = document.getElementById('citySearch').value.toLowerCase();
        var hostelInput = document.getElementById('hostelSearch').value.toLowerCase();

        var hostels = <?php echo json_encode($hostelData); ?>;

        var filteredHostels = hostels.filter(function(hostel) {
            return (cityInput === '' || hostel.location.toLowerCase().includes(cityInput)) &&
                (hostelInput === '' || hostel.hostel_name.toLowerCase().includes(hostelInput));
        });

        displayHostels(filteredHostels);
    });

    function displayHostels(hostels) {
        var hostelListContainer = document.getElementById('hostelList');
        hostelListContainer.innerHTML = '';

        if (hostels.length === 0) {
            hostelListContainer.innerHTML = '<p>No hostels found.</p>';
        } else {
            hostels.forEach(function(hostel) {
                var hostelItem = document.createElement('div');
                hostelItem.className = 'col-xs-12 col-md-6';
                hostelItem.innerHTML = `
                    <div class="room_item-5" data-background='uploads/hostels/${hostel.image}'>

                        <div class="img">
                            <a href="#"><img src="uploads/hostels/${hostel.image}" alt=""></a>
                        </div>

                        <div class="room_item-forward">
                            <h2><a href="#">${hostel.hostel_name}</a></h2>
                        </div>

                        <div class="room_item-back">
                            <h3>${hostel.hostel_name}</h3>
                            <p>${hostel.description}</p>
                            <p>${hostel.location}</p>
                            <a href="room-detail.php?id=${hostel.id}" class="awe-btn awe-btn-13">VIEW DETAILS</a>
                        </div>

                    </div>`;
                hostelListContainer.appendChild(hostelItem);
            });
        }
    }
</script>