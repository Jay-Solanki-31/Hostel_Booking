<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Check if the logged-in user is a student
if ($_SESSION['user_role'] !== 'student') {
    header("Location:studentProfile.php");
    exit();
}

include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$studentid = isset($_SESSION['user_id']) ? $_SESSION['user_id']  :  '';
$studentDetails = $UserController->getStudentsdetails($studentid);
$student = $studentDetails->fetch_assoc();
$complaints = $UserController->getStudentsComplaint($studentid);
$UserController->updateStudentPassword($studentid);
$UserController->insertComplaint();

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
<style>
    .profile-picture {
        text-align: center;
    }

    .profile-picture img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
    }
</style>

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
                            <li><a href="#complaints" data-toggle="tab">Compalints</a></li>
                            <li><a href="#password" data-toggle="tab">Change PAssword</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        </ul>

                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- PROFILE TAB -->
                            <div id="profile" class="tab-pane fade active in">
                                <h3>Profile Details</h3>
                                <div class="profile-picture">
                                    <img src="uploads/students/<?= $student['image'] ?? 'N/A' ?>" alt="Profile Picture" class="rounded-circle">
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="full_name">Name</label>
                                        <input type="text" class="form-control" id="full_name" value="<?= $student['full_name'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="location" value="<?= $student['email'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_no">Contact No</label>
                                        <input type="text" class="form-control" id="contact_no" value="<?= $student['contact_no'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">address </label>
                                        <input type="text" class="form-control" id="address" value="<?= $student['address'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_date">Date of Registration</label>
                                        <input type="text" class="form-control" id="created_date" value="<?= $student['created_date'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="text-end mt-4" style="text-align: left!important;">
                                        <a href="editStudent-Profile.php" class="btn btn-primary">Edit Profile</a>
                                        <a href="index.php" style="margin-left: 5px">Cancel</a>
                                    </div>
                                </form>
                            </div>





                            <!-- COMPLAINTS HISTORY TAB -->
                            <div id="complaints" class="tab-pane fade">
                                <h3>Complaints History <a href="#" class="btn btn-primary" style="margin-left: 485px;" data-toggle="modal" data-target="#addComplaintModal">Add Complaint</a></h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th>Hostel Name </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($complaint = $complaints->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $complaint['full_name'] ?></td>
                                                <td><?= $complaint['hostel_name'] ?></td>
                                                <td><?= $complaint['description'] ?></td>
                                                <td>
                                                    <?php foreach ($complaintStatus as $status) : ?>
                                                        <?php if ($status['value'] == $complaint['status']) : ?>
                                                            <button type="button" class="btn btn-sm <?= $status['color']; ?>">
                                                                <?= $status['status']; ?>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><?= $complaint['created_date'] ?></td>

                                            </tr>
                                        <?php endwhile; ?>

                                    </tbody>

                                </table>

                                <?php if ($complaints->num_rows === 0) : ?>
                                    <p>No complaints found.</p>
                                <?php endif; ?>
                            </div>





                            <!-- CHANGE PASSWORD TAB -->
                            <div id="password" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title" style="margin-bottom:25px;">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="">
                                            <div class="row form-group">
                                                <label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" required>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" required>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="confirm_password" class="col-sm-3 col-form-label input-label">Confirm New password</label>
                                                <div class="col-sm-9">
                                                    <div class="mb-3">
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required confirm="#new_password">
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
        </div>
    </div>
</section>


<!-- Add Complaint Modal -->
<div class="modal fade" id="addComplaintModal" tabindex="-1" role="dialog" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComplaintModalLabel">Add Complaint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="" method="post" action="">
                    <div class="form-group">
                        <label for="complaintDescription">Description*</label>
                        <textarea rows="3" class="form-control" id="complaintDescription" name="complaintDescription" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hostelName">Hostel Name*</label>
                        <input type="text" class="form-control" id="hostelName" name="hostelName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include "main_footer.php" ?>

<script>
    function deletehostel(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "hostelProfile.php?delateid=" + id;
        }
    }

    function deleteInquery(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "hostelProfile.php?delateid=" + id;
        }
    }
</script>