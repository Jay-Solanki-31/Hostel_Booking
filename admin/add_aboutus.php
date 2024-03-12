<?php include 'main_header.php';
include "../config/AdminController.php";

$AdminController = new AdminController();
$AdminController->add_AboutUS();
include 'main_sidebar.php';
?>

<style>
    #image-preview {
        width: 100%;
        height: 400px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
        display: none;
        /* Hide the preview initially */
        overflow: hidden;
        /* Hide overflow content */
    }

    #image-preview img {
        max-width: 100%;
        height: 100%;
        /* Adjust the height to fill the container */
        display: block;
        margin: 0 auto;
        /* Center the image horizontally */
    }
</style>
</head>

<body>


    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">About-US</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">About-US</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" id="EdithostelForm" enctype="multipart/form-data">

                                    <h4 class="card-title mt-4">Image Upload</h4>
                                    <div class="form-group">
                                        <label for="image">Select Image:</label>
                                        <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)" class="form-control">
                                    </div>
                                    <div id="image-preview" class="mb-3"></div>
                                    <div class="form-group">
                                        <label>Description*</label>
                                        <textarea rows="3" cols="4" class="form-control" name="description" id="description" style="font-weight: bold;"></textarea>
                                    </div>
                                    <div class="text-end mt-4" style="text-align: left!important;">
                                        <button type="submit" class="btn btn-primary">Upload </button>
                                        <a href="about-us.php" style="margin-left: 5px;">Cancel</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php require "main_footer.php" ?>
        </div>


        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('image-preview');
                    output.innerHTML = '<img src="' + reader.result + '" />';
                    output.style.display = 'block'; // Display the preview
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>

</body>