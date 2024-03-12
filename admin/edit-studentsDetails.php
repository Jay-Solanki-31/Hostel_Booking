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
$studentid = isset($_GET['id']) ? $_GET['id']  :  '';

$studentDetails = $AdminController->getStudentsdetails($studentid);
$student = $studentDetails->fetch_assoc();
$AdminController->updateStudentInfo();


?>



<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                            <li class="breadcrumb-item active">Edit Students</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="EditStudentInfo" enctype="multipart/form-data">

                                <h4 class="card-title">Students Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Name*</label>
                                            <input type="text" name="studentname" id="studentname" value="<?= $student['full_name']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" id="email" value="<?= $student['email']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" name="contact_no" id="contact_no" value="<?= $student['contact_no']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Password*</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Student Image*</label>
                                            <input class="form-control" name="image" id="image" type="file"  onchange="previewstudentImage()" >
                                            <img id="studentImagePreview" src="../uploads/students/<?= $student['image']; ?>" class="img-thumbnail mt-2" style="width:30%;" alt="Student Image Preview">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Address*</label>
                                            <textarea rows="5" cols="5" class="form-control" name="address" id="address"><?= $student['address']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="role" value="Student">

                                <div class="text-end mt-4" style="text-align: left!important;">
                                    <button type="submit" id="SubmitStudentInfo" class="btn btn-primary">Save</button>
                                    <a href="students.php" style="margin-left: 5px">Cancel</a>
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
    function previewstudentImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('studentImagePreview');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
</script>
