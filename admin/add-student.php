<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
} 

require "main_header.php";


include "../config/AdminController.php";

$AdminController = new AdminController();
$AdminController->add_studentInfo();

?>
<?php require "main_sidebar.php"; ?>


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="students.php">Students</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="StudentInfo" enctype="multipart/form-data">

                                <h4 class="card-title">Students Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Name*</label>
                                            <input type="text" name="studentname" id="studentname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" name="contact_no" id="contact_no" class="form-control">
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
                                            <input class="form-control" name="image" id="image" type="file" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Address*</label>
                                            <textarea rows="5" cols="5" class="form-control" name="address" id="address"></textarea>
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