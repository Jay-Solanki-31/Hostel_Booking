<style>
    .card {
        margin: 0 auto;
        float: none;
        margin-top: 120px;
    }
</style>

<?php

include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$UserController->add_hostel();
?>


<div class="main-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" id="hostelForm" enctype="multipart/form-data">
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
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="basic_bedding" class="form-check-input">
                                            <label class="form-check-label">Basic Bedding</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="shared_bathroom" class="form-check-input">
                                            <label class="form-check-label">Shared Bathroom</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="wifi" class="form-check-input">
                                            <label class="form-check-label">Wi-Fi</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="security" class="form-check-input">
                                            <label class="form-check-label">Security</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="reception" class="form-check-input">
                                            <label class="form-check-label">24/7 Reception</label>
                                        </div>
                                    </div>

                                    <div id="premiumHostelAmenities" style="display: none;">
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="luxurious_bedding" class="form-check-input">
                                            <label class="form-check-label">Luxurious Bedding</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="ensuite_bathroom" class="form-check-input">
                                            <label class="form-check-label">Ensuite Bathroom</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="lounge_area" class="form-check-input">
                                            <label class="form-check-label">Lounge Area</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="gourmet_breakfast" class="form-check-input">
                                            <label class="form-check-label">Gourmet Breakfast</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="concierge_service" class="form-check-input">
                                            <label class="form-check-label">Concierge Service</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="premium_security" class="form-check-input">
                                            <label class="form-check-label">Security Features</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="daily_housekeeping" class="form-check-input">
                                            <label class="form-check-label">Daily Housekeeping</label>
                                        </div>
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

                                </div>


                                <div class="col-md-12 text-end mt-4">
                                    <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                    <a href="hostelProfile.php" style="margin-left: 5px" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php require "main_footer.php" ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.querySelector("select[name='status']");
        toggleAmenities(selectElement);

        selectElement.addEventListener("change", function() {
            toggleAmenities(this);
        });
    });

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
</script>