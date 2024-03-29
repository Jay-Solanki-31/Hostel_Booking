<style>
    .card {
        margin: 0 auto; 
        float: none; 
        margin-top: 120px;
    }
   
</style>

<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelid = isset($_GET['id']) ? $_GET['id'] : '';
$hostelDetails = $UserController->gethosteldetails($hostelid);
$hostel = $hostelDetails->fetch_assoc();
$UserController->update_hostel();

?>
?>


<div class="main-wrapper">
    <div class="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="EdithostelForm" enctype="multipart/form-data">
                                <h4 class="card-title mt-4">Hostel Information </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hostel Pictures</label>
                                            <input class="form-control" name="picture" id="picture" type="file" onchange="previewHostelImage()">
                                            <img id="hostelImagePreview" src="uploads/hostels/<?= $hostel['image']; ?>" class="img-thumbnail mt-2" style="width:30%;" alt="Hostel Image Preview">
                                        </div>
                                        <div class="form-group">
                                            <label>Description*</label>
                                            <textarea rows="3" cols="4" class="form-control" name="description" id="description"><?= $hostel['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Hostel Name*</label>
                                            <input type="text" name="hostelName" value="<?= $hostel['hostel_name']; ?>" id="hostelName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Location*</label>
                                            <input type="text" name="location" value="<?= $hostel['location']; ?>" id="location" class="form-control">
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
                                            <input type="checkbox" name="amenities[]" value="Basic bedding" class="form-check-input">
                                            <label class="form-check-label">Basic Bedding</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Shared bathroom" class="form-check-input">
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
                                            <input type="checkbox" name="amenities[]" value="luxurious bedding" class="form-check-input">
                                            <label class="form-check-label">Luxurious Bedding</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Ensuite bathroom" class="form-check-input">
                                            <label class="form-check-label">Ensuite Bathroom</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Lounge area" class="form-check-input">
                                            <label class="form-check-label">Lounge Area</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Gourmet breakfast" class="form-check-input">
                                            <label class="form-check-label">Gourmet Breakfast</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Concierge service" class="form-check-input">
                                            <label class="form-check-label">Concierge Service</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Premium security" class="form-check-input">
                                            <label class="form-check-label">Security Features</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="amenities[]" value="Daily housekeeping" class="form-check-input">
                                            <label class="form-check-label">Daily Housekeeping</label>
                                        </div>
                                    </div>

                                    </div>


                                </div>
                                <div class="text-end mt-4" style="text-align: left!important;">
                                    <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                    <a href="hostelProfile.php" style="margin-left: 5px;">Cancel</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>

    <?php require "main_footer.php" ?>
</div>



<script>
    function previewHostelImage() {
        const input = document.getElementById('picture');
        const preview = document.getElementById('hostelImagePreview');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }


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
