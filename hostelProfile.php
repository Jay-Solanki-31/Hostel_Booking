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

$UserController->assignHostel();

if (isset($_POST['name'])) {
    $UserController->updateOwnerInfo();
}

if (isset($_POST['hostelName'])) {
    $UserController->add_hostel();
}

$UserController->updateHostelPassword($hostelid);

$complaints = $UserController->gethostelcomplaint($hostelid);
$inquerylist = $UserController->gethostelinquery($hostelid);
$assignbookinglist = $UserController->getassiggnhosteldata($hostelid);
$hostellist = $UserController->gethostelInformation($hostelid);
$registerStudentlist = $UserController->getregisterStudentInfo();


$formName = isset($_POST['formName']) ? $_POST['formName']  :  '';
if ($formName && $formName == "complaintStatus") {
    $UserController->updatecomplaintStatus();
}


$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if ($delateid) {
    $delatehostel = $UserController->deleteHostel($delateid);
    $delateComplain = $UserController->deleteComplain($delateid);
    $delateassignHostel = $UserController->deleteassignHostel($delateid);
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

    #hostelFormWrapper {
        display: none;
        animation: fadeInOut 0.8s ease;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    #AssignhostelFormWrapper {
        display: none;
        animation: fadeInOut 0.8s ease;
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
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
                            <li><i class="fa-thin fa-user-secret"></i><a href="#ManageHostels"  data-toggle="tab">Manage Hostel</a></li>
                            <li><a href="#complaints" data-toggle="tab">Complaints</a></li>
                            <li><a href="#Inquery" data-toggle="tab">inquiry</a></li>
                            <li><a href="#assignBooking" data-toggle="tab">Assign Booking</a></li>
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
                                <form action="" method="post" id="EditOwnerForm" enctype="multipart/form-data">
                                    <h4 class="card-title">Owner Information</h4>
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <input class="form-control" name="picture" id="picture" type="file"">
                                  </div>
                                        <div class=" form-group">
                                        <label>Name*</label>
                                        <input type="text" name="name" value="<?= $hostel['full_name']; ?>" id="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone*</label>
                                        <input type="text" name="phone" value="<?= $hostel['contact_no']; ?>" id="phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" name="email" value="<?= $hostel['email']; ?>" id="email" class="form-control">
                                    </div>
                                    <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                    <a href="hostelProfile.php" class="btn btn-secondary">Cancel</a>
                                </form>

                            </div>

                            <!-- Manage Hostel TAB -->
                            <div id="ManageHostels" class="tab-pane fade">
                                <h3>My Hostel <button id="addHostelBtn" class="btn btn-primary" style="margin-left: 619px;">Add Hostel</button></h3>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name </th>
                                            <th>location</th>
                                            <th>Image</th>
                                            <th>RegisterDate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($hostel = $hostellist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><img src="uploads/hostels/<?= $hostel['image'] ?>" alt="Hostel Image" style="max-height: 100px; max-width: 100px;"></td>
                                                <td><?= $hostel['hostel_name'] ?></td>
                                                <td><?= $hostel['location'] ?></td>
                                                <td><?= $hostel['created_date'] ?></td>
                                                <td>
                                                    <a href="edit-hostel.php?id=<?= $hostel['id']; ?>" class="btn btn-sm btn-white text-primary me-2"><i class="bi bi-pencil"></i></a>
                                                    <a href="javascript:;" onclick="deletehostel(<?= $hostel['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="bi bi-trash"></i></a>
                                                    <a href="hostels-detail.php?id=<?= $hostel['id']; ?>" class="btn btn-sm btn-white text-success me-2"><i class="bi bi-eye"></i></a>


                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>


                                </table>


                                <?php if ($hostellist->num_rows === 0) : ?>
                                    <p>No Hostel.</p>
                                <?php endif; ?>
                            </div>



                            <!-- Add Hostel Form Container -->
                            <div id="hostelFormWrapper" style="display: none;">
                                <!-- Your Add Hostel form goes here -->
                                <form method="post" id="hostelForm" enctype="multipart/form-data">
                                    <h4 class="card-title mt-4">Hostel Information </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Hostel Image*</label>
                                                <input class="form-control" name="image" id="image" type="file" multiple>
                                            </div>


                                            <div class="form-group">
                                                <label>Hostel Amenities*</label>
                                                <select name="status" class="form-select" onchange="toggleAmenities(this)">
                                                    <option value="1">Normal Amenities</option>
                                                    <option value="0">Premium Amenities</option>
                                                </select>
                                            </div>
                                            <div id="normalHostelAmenities" style="display: none;">
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Basic bedding" class="form-check-input">
                                                    <label class="form-check-label">Basic Bedding</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Shared bathroom" class="form-check-input">
                                                    <label class="form-check-label">Shared Bathroom</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="wifi" class="form-check-input">
                                                    <label class="form-check-label">Wi-Fi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="security" class="form-check-input">
                                                    <label class="form-check-label">Security</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="reception" class="form-check-input">
                                                    <label class="form-check-label">24/7 Reception</label>
                                                </div>
                                            </div>

                                            <div id="premiumHostelAmenities" style="display: none;">
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="luxurious bedding" class="form-check-input">
                                                    <label class="form-check-label">Luxurious Bedding</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Ensuite bathroom" class="form-check-input">
                                                    <label class="form-check-label">Ensuite Bathroom</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Lounge area" class="form-check-input">
                                                    <label class="form-check-label">Lounge Area</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Gourmet breakfast" class="form-check-input">
                                                    <label class="form-check-label">Gourmet Breakfast</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Concierge service" class="form-check-input">
                                                    <label class="form-check-label">Concierge Service</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Premium security" class="form-check-input">
                                                    <label class="form-check-label">Security Features</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" name="amenities[]" value="Daily housekeeping" class="form-check-input">
                                                    <label class="form-check-label">Daily Housekeeping</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description*</label>
                                                <textarea rows="3" cols="3" class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Hostel Name*</label>
                                                <input type="text" name="hostelName" id="hostelName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Location*</label>
                                                <input type="text" name="location" id="location" class="form-control">
                                            </div>

                                        </div>


                                        <div class="col-md-12 text-end mt-4">
                                            <button type="submit" id="submitHostel" class="btn btn-primary">Save</button>
                                            <a style="margin-left: 5px" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
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
                                                <td><?= $inquery['name'] ?></td>
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
                                <?php if ($inquerylist->num_rows === 0) : ?>
                                    <p>No Inquery found.</p>
                                <?php endif; ?>
                            </div>


                            <!-- Assign Booking TAB -->
                            <div id="assignBooking" class="tab-pane fade">
                                <h3>Assign Booking List <button id="assignHostelBtn" style="margin-left: 502px;" class="btn btn-primary">Assign Hostel</button></h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Hostel Name</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($assign = $assignbookinglist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $assign['hostel_name'] ?></td>
                                                <td><?= $assign['student_name'] ?></td>
                                                <td><?= $assign['student_email'] ?></td>
                                                <td><?= $assign['student_contactno'] ?></td>
                                                <td><?= $assign['created_date'] ?></td>
                                                <td>
                                                    <a href="javascript:;" onclick="deleteassignHostel(<?= $assign['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>

                                            </tr>
                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- assign hostel tab -->
                            <div id="AssignhostelFormWrapper" style="display: none;">
                                <form method="post" id="assignhostelForm">
                                    <h4 class="card-title mt-4">Assign Hostel: </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hostelDropdown">Select Hostel:</label>
                                                <input type="hidden" name="action" value="assign_hostel">
                                                <select id="hostelDropdown" name="hostel">
                                                    <?php foreach ($hostellist as $hostel) { ?>
                                                        <option value="<?php echo $hostel['hostel_name']; ?>"><?php echo $hostel['hostel_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="studentEmailDropdown">Select Student Email:</label>
                                                <select id="studentEmailDropdown" name="student_email">
                                                    <?php foreach ($registerStudentlist as $student) { ?>
                                                        <option value="<?php echo $student['email']; ?>"><?php echo $student['email']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-end mt-4">
                                            <button type="button" id="AssignHostel" class="btn btn-primary">Assign</button>
                                            <a style="margin-left: 5px" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <!-- CHANGE PASSWORD TAB -->
                            <div id="password" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title" style="margin-bottom:25px;">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" id="passwordForm" action="">
                                            <div class="row form-group">
                                                <label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="new_password" class="col-sm-3 col-form-label input-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="confirm_password" class="col-sm-3 col-form-label input-label">Confirm New password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password">
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

<!--  -->


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


    function deleteassignHostel(id) {
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


    function toggleAmenities(selectElement) {
        var normalHostelAmenitiesDiv = document.getElementById("normalHostelAmenities");
        var premiumHostelAmenitiesDiv = document.getElementById("premiumHostelAmenities");

        if (selectElement.value === "1") { // Normal Hostel selected
            normalHostelAmenitiesDiv.style.display = "block";
            premiumHostelAmenitiesDiv.style.display = "none";
        } else if (selectElement.value === "0") { // Premium Hostel selected
            normalHostelAmenitiesDiv.style.display = "none";
            premiumHostelAmenitiesDiv.style.display = "block";
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addHostelBtn = document.getElementById("addHostelBtn");
        const manageHostelTab = document.getElementById("ManageHostels");
        const hostelFormWrapper = document.getElementById("hostelFormWrapper");
        const tabContent = document.querySelector(".room-detail_tab-content");

        addHostelBtn.addEventListener("click", function() {
            // Toggle Add Hostel form visibility
            if (hostelFormWrapper.style.display === "block") {
                hostelFormWrapper.style.display = "none";
            } else {
                hostelFormWrapper.style.display = "block";
                // Move the Manage Hostel tab below the Add Hostel form
                tabContent.insertBefore(manageHostelTab, hostelFormWrapper.nextElementSibling);
            }
        });

        // Function to hide the Add Hostel form when Cancel is clicked
        const cancelBtn = document.querySelector('#hostelFormWrapper .btn-secondary');
        cancelBtn.addEventListener('click', function() {
            hostelFormWrapper.style.display = "none";
        });

        // Hide the Add Hostel form when other tabs are clicked
        const tabLinks = document.querySelectorAll('.room-detail_tab-header a');

        tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('click', function() {
                if (!this.href.includes('#ManageHostels')) {
                    hostelFormWrapper.style.display = "none";
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const assignHostelBtn = document.getElementById("assignHostelBtn");
        const assignBookingTab = document.getElementById("assignBooking");
        const assignFormWrapper = document.getElementById("AssignhostelFormWrapper");
        const tabContent = document.querySelector(".room-detail_tab-content");

        assignHostelBtn.addEventListener("click", function() {
            // Toggle Assign Hostel form visibility
            if (assignFormWrapper.style.display === "block") {
                assignFormWrapper.style.display = "none";
            } else {
                assignFormWrapper.style.display = "block";
                // Move the Assign Booking tab below the Assign Hostel form
                tabContent.insertBefore(assignBookingTab, assignFormWrapper.nextElementSibling);
            }
        });

        // Function to hide the Assign Hostel form when Cancel is clicked
        const cancelBtn = document.querySelector('#AssignhostelFormWrapper .btn-secondary');
        cancelBtn.addEventListener('click', function() {
            assignFormWrapper.style.display = "none";
        });

        // Hide the Assign Hostel form when other tabs are clicked
        const tabLinks = document.querySelectorAll('.room-detail_tab-header a');

        tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('click', function() {
                if (!this.href.includes('#assignBooking')) {
                    assignFormWrapper.style.display = "none";
                }
            });
        });
    });
</script>