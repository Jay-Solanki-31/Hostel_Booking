<style>
    .round-div {
        width: 150px;
        height: 150px;
        background-color: #ccc;
        border-radius: 50%;
        text-align: center;
        line-height: 150px;
        cursor: pointer;
    }

    .round-div img {
        max-width: 100%;
        max-height: 100%;
    }
</style>

<?php
ob_start();
session_start();
require "main_header.php";
require "main_sidebar.php";

include "../config/AdminController.php";
$AdminController = new AdminController();
$AdminData = $AdminController->displayAdminDetails();

if (isset($_POST['new_password'])) {
    $AdminController->updateAdminPassword();
}

if (isset($_POST['email'])) {
    $AdminController->updateAdminInfo();
}


?>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="page-title">Settings</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Profile Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Basic information</h5>
                            </div>
                            <div class="card-body">

                                <form action="" method="POST" enctype="multipart/form-data">

                                    <div class="row form-group">
                                        <label for="profile_image" class="col-sm-3 col-form-label input-label">Profile Image</label>
                                        <div class="col-sm-9">
                                            <div class="round-div" id="profile_image_preview">
                                                <?php if (!empty($AdminData['image'])) : ?>
                                                    <img src="../uploads/owners/<?php echo $AdminData['image']; ?>" alt="Profile Image">
                                                <?php else : ?>
                                                    <span>N/A</span>
                                                <?php endif; ?>
                                            </div>
                                            <input type="file" class="form-control file-input" id="profile_image" name="profile_image" style="display: none;">
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <label for="name" class="col-sm-3 col-form-label input-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="full_name" value="<?php echo $AdminData['full_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name='email' value="<?php echo $AdminData['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label for="phone" class="col-sm-3 col-form-label input-label">Phone </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name='phone' value="<?php echo $AdminData['contact_no']; ?>">
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Change Password</h5>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="">
                                    <div class="row form-group">
                                        <label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" require>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" require>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label for="confirm_password" class="col-sm-3 col-form-label input-label">Confirm New password</label>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" require confirm="##new_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" onclick="" class="btn btn-primary">Change Password</button>
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
</body>

<script>
    document.getElementById('profile_image_preview').addEventListener('click', function() {
        document.getElementById('profile_image').click();
    });

    document.getElementById('profile_image').addEventListener('change', function(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var imgElement = document.createElement("img");
            imgElement.src = reader.result;
            imgElement.onload = function() {
                // Adjust the size of the image to fit within the round div
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                var max_width = 150,
                    max_height = 150;
                var width = imgElement.width,
                    height = imgElement.height;

                if (width > height) {
                    if (width > max_width) {
                        height *= max_width / width;
                        width = max_width;
                    }
                } else {
                    if (height > max_height) {
                        width *= max_height / height;
                        height = max_height;
                    }
                }

                canvas.width = width;
                canvas.height = height;
                ctx.drawImage(imgElement, 0, 0, width, height);

                var roundedCanvas = document.createElement("canvas");
                var roundedCtx = roundedCanvas.getContext("2d");
                roundedCanvas.width = width;
                roundedCanvas.height = height;
                roundedCtx.beginPath();
                roundedCtx.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
                roundedCtx.closePath();
                roundedCtx.clip();
                roundedCtx.drawImage(canvas, 0, 0, width, height);

                document.getElementById('profile_image_preview').innerHTML = '';
                document.getElementById('profile_image_preview').appendChild(roundedCanvas);
            };
        };
        reader.readAsDataURL(input.files[0]);
    });
</script>