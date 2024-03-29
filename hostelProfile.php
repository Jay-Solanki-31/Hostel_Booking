<?php
session_start();
function isLoggedIn()
{
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user_role'] !== 'hostel') {
    header("Location:hostelProfile.php");
    exit();
}

include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelid = isset($_SESSION['user_id']) ? $_SESSION['user_id']  :  '';
$hostelDetails = $UserController->gethostelsdetails($hostelid);
$hostel = $hostelDetails->fetch_assoc();
$UserController->updateHostelPassword($hostelid);

$complaints = $UserController->gethostelcomplaint($hostelid);
$inquerylist = $UserController->gethostelinquery($hostelid);
$hostellist = $UserController->gethostelInformation($hostelid);


$formName = isset($_POST['formName']) ? $_POST['formName']  :  '';
if ($formName && $formName == "complaintStatus") {
    $UserController->updatecomplaintStatus();
}


$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if ($delateid) {
    $delatehostel = $UserController->deleteHostel($delateid);
    $delateComplain = $UserController->deleteComplain($delateid);
    $delateInquey = $UserController->deleteInquery($delateid);
}

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
                            <li><a href="#ManageHostels" data-toggle="tab">Manage Hostel</a></li>
                            <li><a href="#complaints" data-toggle="tab">Complaints</a></li>
                            <li><a href="#Inquery" data-toggle="tab">Inquery</a></li>
                            <li><a href="#password" data-toggle="tab">Change PAssword</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        </ul>

                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- PROFILE TAB -->
                            <div id="profile" class="tab-pane fade active in">
                                <h3>Owner Details</h3>
                                <div class="profile-picture">
                                    <img src="uploads/owners/<?= $hostel['image'] ?? 'N/A' ?>" alt="Profile Picture" class="rounded-circle">
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="hostel_name">Name</label>
                                        <input type="text" class="form-control" id="full_name" value="<?= $hostel['full_name'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Email</label>
                                        <input type="text" class="form-control" id="location" value="<?= $hostel['email'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_no">Contact No</label>
                                        <input type="text" class="form-control" id="contact_no" value="<?= $hostel['contact_no'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_date">Date of Registration</label>
                                        <input type="text" class="form-control" id="created_date" value="<?= $hostel['created_date'] ?? 'N/A' ?>" readonly>
                                    </div>
                                    <div class="text-end mt-4" style="text-align: left!important;">
                                        <a href="editOwnerprofile.php" class="btn btn-primary">Edit Profile</a>
                                        <a href="index.php" style="margin-left: 5px">Cancel</a>
                                    </div>
                                </form>
                            </div>

                            <!-- Manage Hostel TAB -->
                            <div id="ManageHostels" class="tab-pane fade">
                                <h3>My Hostel <a href="add-hostel.php" class="btn btn-primary" style="margin-left: 619px;">Add Hostel</a></h3>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name </th>
                                            <th>Description </th>
                                            <th>location</th>
                                            <th>image</th>
                                            <th>amenities</th>
                                            <th>RegisterDate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($hostel = $hostellist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $hostel['hostel_name'] ?></td>
                                                <td>
                                                    <?php
                                                    $description = $hostel['description'];
                                                    $words = str_word_count($description, 2);
                                                    $limitedWords = array_slice($words, 0, 10);
                                                    $limitedDescription = implode(' ', $limitedWords);
                                                    echo $limitedDescription;
                                                    ?>
                                                </td>
                                                <td><?= $hostel['location'] ?></td>
                                                <td><img src="uploads/hostels/<?= $hostel['image'] ?>" alt="Hostel Image" height="5px" ,width="100px;"></td>
                                                <td>
                                                    <?php
                                                    $amenities_array = explode(',', $hostel['amenities']);
                                                    foreach ($amenities_array as $amenity) {
                                                        echo $amenity . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $hostel['created_date'] ?></td>
                                                <td>
                                                    <a href="edit-hostel.php?id=<?= $hostel['id']; ?>" class="btn btn-sm btn-white text-primary me-2"><i class="far fa-edit me-1"></i> Edit</a>
                                                    <a href="javascript:;" onclick="deletehostel(<?= $hostel['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>


                                </table>


                                <?php if ($hostellist->num_rows === 0) : ?>
                                    <p>No Hostel.</p>
                                <?php endif; ?>
                            </div>




                            <!-- COMPLAINTS HISTORY TAB -->
                            <div id="complaints" class="tab-pane fade">
                                <h3>Complaints History</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Student Name </th>
                                            <th>Hostel Name </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($complaint = $complaints->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $complaint['student_name'] ?></td>
                                                <td><?= $complaint['hostel_name'] ?></td>
                                                <td><?= $complaint['description'] ?></td>
                                                <td>
                                                    <?php foreach ($complaintStatus as $status) : ?>
                                                        <?php if ($status['value'] == $complaint['status']) : ?>
                                                            <button type="button" class="btn btn-sm <?= $status['color']; ?>" onclick="openEditStatusModal(<?= $complaint['id']; ?>, <?= $status['value']; ?>, '<?= $status['status']; ?>')">
                                                                <?= $status['status']; ?>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><?= $complaint['created_date'] ?></td>
                                                <td>
                                                    <a href="javascript:;" onclick="deleteComplain(<?= $complaint['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>

                                    </tbody>

                                </table>

                                <?php if ($complaints->num_rows === 0) : ?>
                                    <p>No complaints found.</p>
                                <?php endif; ?>
                            </div>


                            <!-- inquery TAB -->
                            <div id="Inquery" class="tab-pane fade">
                                <h3>Inquery List</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Student Name </th>
                                            <th>Hostel Name </th>
                                            <th>Email </th>
                                            <th>Contact No</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($inquery = $inquerylist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $inquery['student_name'] ?></td>
                                                <td><?= $inquery['hostel_name'] ?></td>
                                                <td><?= $inquery['email'] ?></td>
                                                <td><?= $inquery['contact_no'] ?></td>
                                                <td><?= $inquery['description'] ?></td>
                                                <td><?= $inquery['created_date'] ?></td>
                                                <td>
                                                    <a href="javascript:;" onclick="deleteInquery(<?= $inquery['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
                                <?php if ($complaints->num_rows === 0) : ?>
                                    <p>No Inquery found.</p>
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
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
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


<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Complaint Status</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <input type="hidden" id="complaintId" name="complaintId" value="">
                    <input type="hidden" name="formName" value="complaintStatus">
                    <select class="form-select" name="newStatus" id="newStatus">
                        <?php foreach ($complaintStatus as $status) : ?>
                            <option value="<?= $status['value']; ?>"><?= $status['status']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Update Status</button>
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

    function deleteComplain(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "hostelProfile.php?delateid=" + id;
        }
    }


    function openEditStatusModal(id, currentStatusValue, currentStatusText) {
        $('#complaintId').val(id);
        $('#newStatus').val(currentStatusValue);
        $('#editStatusModal').modal('show');
    }

    function getStatusLabel(statusValue) {
        for (let status of <?= json_encode($complaintStatus); ?>) {
            if (status.value == statusValue) {
                return status.value + ' = ' + status.status;
            }
        }
        return '';
    }
</script>