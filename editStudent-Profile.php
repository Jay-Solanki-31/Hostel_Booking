<style>
    .card {
        margin: 0 auto; 
        float: none; 
        margin-top: 120px;
    }
   
</style>

<?php
session_start();
// function isLoggedIn() {
//     return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
// }

// if (!isLoggedIn()) {
//     header("Location: login.php");
//     exit();
// }
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$studentid = isset($_SESSION['user_id']) ? $_SESSION['user_id']  :  '';
$studentDetails = $UserController->getStudentsdetails($studentid);
$student = $studentDetails->fetch_assoc();
$UserController->updateStudentInfo();
?>

<div class="main-wrapper">
    <div class="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="EditStudentForm" enctype="multipart/form-data">
                                <h4 class="card-title">Owner Information</h4>
                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input class="form-control" name="picture" id="picture" type="file"">
                                        </div>
                                        <div class="form-group">
                                            <label>Name*</label>
                                            <input type="text" name="name" value="<?= $student['full_name']; ?>" id="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" name="phone" value="<?= $student['contact_no']; ?>" id="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" value="<?= $student['email']; ?>" id="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>address*</label>
                                            <input type="text" name="address" value="<?= $student['address']; ?>" id="address" class="form-control">
                                        </div>
                                    <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                    <a href="studentProfile.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php require "main_footer.php" ?>
</div>
