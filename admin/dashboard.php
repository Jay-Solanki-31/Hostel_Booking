<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}
require "main_header.php";
include "../config/AdminController.php";
$AdminController = new AdminController();
$hostelCount = $AdminController->DisplayHostelCount();
$StudentCount = $AdminController->DisplayStudentCount();
$ComplaintsCount = $AdminController->DisplayComplaintsCount();
$ContactCount = $AdminController->DisplayContactCount();
$BookingInqueryCount = $AdminController->DisplayBookingCount();


?>

<?php require "main_sidebar.php"; ?>

<body class="nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="hostels.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-1">
                                            <i class="fas fa-home"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Hostels</div>
                                            <div class="dash-counts">
                                                <p><?php echo $hostelCount; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="students.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-2">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Students</div>
                                            <div class="dash-counts">
                                                <p><?php echo $StudentCount; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="complaint.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-3">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Complaints</div>
                                            <div class="dash-counts">
                                                <p><?php echo $ComplaintsCount; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-7" role="progressbar" style="width: 85%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="contacts.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-4">
                                            <i class="far fa-file"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Contacts</div>
                                            <div class="dash-counts">
                                                <p><?php echo $ContactCount; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <a href="booking_inquiries.php">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dash-widget-header">
                                        <span class="dash-widget-icon bg-4">
                                            <i class="far fa-file"></i>
                                        </span>
                                        <div class="dash-count">
                                            <div class="dash-title">Booking Inquiries</div>
                                            <div class="dash-counts">
                                                <p><?php echo $BookingInqueryCount; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p> -->
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php require "main_footer.php"; ?>
</body>