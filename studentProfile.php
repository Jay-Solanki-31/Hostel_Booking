<?php
session_start();
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$studentid = isset($_SESSION['user_id']) ? $_SESSION['user_id']  :  '';
$studentDetails = $UserController->getStudentsdetails($studentid);
$student = $studentDetails->fetch_assoc();
$complaints = $UserController->getStudentsComplaint($studentid);

// Define the complaint status array
$complaintStatus = [
    [
        "value" => "1",
        "status" => "Pending",
        "color" => "bg-danger-light",
    ],
    [
        "value" => "2",
        "status" => "In Progress",
        "color" => "bg-warning-light",
    ],
    [
        "value" => "3",
        "status" => "Resolved",
        "color" => "bg-success-light",
    ],
];
?>

<section class="section-sub-banner bg-16">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>My Profile</h2>
            </div>
        </div>
    </div>
</section>

<section class="section-room-detail bg-white">
    <div class="container">
        <div class="room-wrap-5">
            <div class="room-detail_tab">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="room-detail_tab-header">
                            <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                            <li><a href="#complaints" data-toggle="tab">Compalints History</a></li>
                            <li><a href="#password" data-toggle="tab">Change PAssword</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- PROFILE TAB -->
                            <div id="profile" class="tab-pane fade active in">
                                <h3>Student Details</h3>
                                <table class="table">
                                    <tr>
                                        <th>Student ID</th>
                                        <td><?= $student['id'] ?? 'N/A' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $student['email'] ?? 'N/A' ?></td>
                                    </tr>
                                </table>
                            </div>


                            <!-- COMPLAINTS HISTORY TAB -->
                            <div id="complaints" class="tab-pane fade">
                                <h3>Complaints History</h3>
                                <?php if ($complaints && $complaints->num_rows > 0) : ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Complaint ID</th>
                                                <th>Subject</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($complaint = $complaints->fetch_assoc()) : ?>
                                                <tr>
                                                    <td><?= $complaint['id'] ?></td>
                                                    <td><?= $complaint['description'] ?></td>
                                                    <td><?= $complaint['created_date'] ?></td>
                                                    <td><span class="badge <?= getStatusColor($complaint['status']) ?>"><?= getStatusLabel($complaint['status']) ?></span></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No complaints found</p>
                                <?php endif; ?>
                            </div>

                            <!-- CHANGE PASSWORD TAB -->
                            <div id="password" class="tab-pane fade">
                                <!-- Change Password Form Goes Here -->
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include "main_footer.php" ?>

<?php
// Function to get the color based on status value
function getStatusColor($statusValue) {
    global $complaintStatus;
    foreach ($complaintStatus as $status) {
        if ($status['value'] == $statusValue) {
            return $status['color'];
        }
    }
    // Default color if status value not found
    return 'bg-secondary-light';
}

// Function to get the label based on status value
function getStatusLabel($statusValue) {
    global $complaintStatus;
    foreach ($complaintStatus as $status) {
        if ($status['value'] == $statusValue) {
            return $status['status'];
        }
    }
    // Default label if status value not found
    return 'Unknown';
}
?>
