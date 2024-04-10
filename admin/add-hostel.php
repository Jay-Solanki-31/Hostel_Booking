<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

require "main_header.php";


include "../config/AdminController.php";

$AdminController = new AdminController();
$AdminController->add_hostel();

?>
<?php require "main_sidebar.php"; ?>


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Hostel</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="hostels.php">Hostel</a></li>
                            <li class="breadcrumb-item active">Add Hostel</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="hostelForm" enctype="multipart/form-data">

                                <h4 class="card-title">Owner Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name*</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" name="phone" id="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password*</label>
                                            <input type="password" name="password" id="password" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-4">Hostel Information </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Hostel Image*</label>
                                            <input class="form-control" name="image" id="image" type="file" accept="image/*" multiple>
                                        </div>

                                        <div class="form-group">
                                            <label>Hostel Type*</label>
                                            <select name="status" class="form-select" onchange="toggleAmenities(this)">
                                                <option value="1">Normal Hostel</option>
                                                <option value="0">Premium Hostel</option>
                                            </select>
                                        </div>
                                        <div id="normalHostelAmenities" style="display: none;">

                                            <?php foreach (NORMAL_AMENITIES as $amenity) {
                                                echo '<div class="form-check">
                                                <input type="checkbox" name="amenities[]" value="' . $amenity['value'] . '" class="form-check-input">
                                                <label class="form-check-label">' . $amenity['name'] . '</label>
                                            </div>';
                                                                                } ?>
                                        </div>

                                        <div id="premiumHostelAmenities" style="display: none;">
    <?php foreach (PREMIUM_AMENITIES as $amenity) {
        echo '<div class="form-check">
                <input type="checkbox" name="amenities[]" value="' . $amenity['value'] . '" class="form-check-input">
                <label class="form-check-label">' . $amenity['name'] . '</label>
            </div>';
    } ?>
</div>

                                        <div class="form-group">
                                            <label>Description*</label>
                                            <textarea rows="3" cols="3" class="form-control" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Hostel Name*</label>
                                            <input type="text" name="hostelName" id="hostelName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Location*</label>
                                            <input type="text" name="location" id="location" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Status*</label>
                                            <select name="status" class="form-select">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="role" value="Hostel">

                                    <div class="text-end mt-4" style="text-align: left!important;">
                                        <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                        <a href="hostels.php" style="margin-left: 5px">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php require "main_footer.php" ?>

<script>
    function toggleAmenities(selectElement) {
        var normalHostelAmenitiesDiv = document.getElementById("normalHostelAmenities");
        var premiumHostelAmenitiesDiv = document.getElementById("premiumHostelAmenities");

        if (selectElement.value === "1") { // Normal Hostel selected
            normalHostelAmenitiesDiv.style.display = "block";
            premiumHostelAmenitiesDiv.style.display = "none";
        } else if (selectElement.value === "0") { // Premium Hostel selected
            normalHostelAmenitiesDiv.style.display = "none";
            premiumHostelAmenitiesDiv.style.display = "block";
        }
    }

    window.onclick = function() {
        var selectElement = document.getElementsByName("status")[0];
        toggleAmenities(selectElement);
    };
</script>