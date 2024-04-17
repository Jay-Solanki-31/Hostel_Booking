<?php
ob_start();
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
} 

require "main_header.php";
require "main_sidebar.php";

include "../config/AdminController.php";

$AdminController = new AdminController();
$hostelid = isset($_GET['id']) ? $_GET['id']  :  '';

$hosteldetails = $AdminController->gethosteldetails($hostelid);
$hostel = $hosteldetails->fetch_assoc();

// update hostel deatils
$AdminController->update_hostel();


?>


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Hostel</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="hostels.php">Hostel</a></li>
                            <li class="breadcrumb-item active">Edit Hostel</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="EdithostelForm" enctype="multipart/form-data">


                                <h4 class="card-title">Owner Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name*</label>
                                            <input type="text" name="name" value="<?= $hostel['full_name']; ?>" id="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" value="<?= $hostel['email']; ?>" id="email" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" name="phone" value="<?= $hostel['contact_no']; ?>" id="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-4">Hostel Information </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                <label>Hostel Pictures</label>
                <input class="form-control" name="pictures[]" id="pictures" type="file" multiple onchange="previewHostelImage()">
                <div id="hostelImagesPreview" class="mt-2"></div>
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
                                            <label>Status*</label>
                                            <select name="status" class="form-select">
                                                <option value="1" <?php echo ($hostel['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                                <option value="0" <?php echo ($hostel['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                            </select>

                                        </div>
                                    </div>


                                </div>
                                <div class="text-end mt-4" style="text-align: left!important;">
                                    <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                    <a href="hostels.php" style="margin-left: 5px;">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require "main_footer.php" ?>
</div>


<script>
    function previewHostelImage() {
        const input = document.getElementById('pictures'); // Change to 'pictures' for multiple file inputs
        const preview = document.getElementById('hostelImagesPreview');
        preview.innerHTML = ''; // Clear previous previews

        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mt-2');
                img.style.width = '30%';
                img.alt = 'Hostel Image Preview';
                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
</script>
