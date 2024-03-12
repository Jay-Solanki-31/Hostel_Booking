<?php
// ob_start();
// session_start();
// if (!isset($_SESSION['user_email'])) {
//     header("Location: index.php");
//     exit();
// } 
require "main_header.php";
require "main_sidebar.php";

include "../config/AdminController.php";
$AdminController = new AdminController();
$AdminData = $AdminController->displayAdminDetails()->fetch_assoc();

if (isset($_POST['new_password'])) {
    $AdminController->updateAdminPassword();
}

if (isset($_POST['email'])) {
    $AdminController->update_AdminInfo();
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

                                <form action="" method="POST">

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
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" require confirm = "##new_password">
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
