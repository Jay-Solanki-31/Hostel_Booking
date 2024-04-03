<?php
session_start();
include 'main_header.php';
include "../config/AdminController.php";

$AdminController = new AdminController();

$slider_id = isset($_GET['id']) ? $_GET['id'] : '' ;

    $slider = $AdminController->getsliderldetails($slider_id);
    $slider = $slider->fetch_assoc();


include 'main_sidebar.php';
?>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Edit Slider</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Slider</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Edit slider form -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="update_slider.php" method="post" enctype="multipart/form-data">
                                    <h4 class="card-title mt-4">Edit Slider</h4>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hostel Pictures</label>
                                            <input class="form-control" name="picture" id="picture" type="file" onchange="previewHostelImage()">
                                            <img id="hostelImagePreview" src="../uploads/slider/<?= $slider['picture']; ?>" class="img-thumbnail mt-2" style="width:100%;" alt="Hostel Image Preview">
                                        </div>
                                        <div class="form-group">
                                            <label>Description*</label>
                                            <textarea rows="3" cols="4" class="form-control" name="description" id="description"><?= $slider['info']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Update Slider</button>
                                        <a href="slider.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require "main_footer.php"; ?>

   
<script>
    function previewsliderImage() {
        const input = document.getElementById('picture');
        const preview = document.getElementById('hostelImagePreview');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
</script>
