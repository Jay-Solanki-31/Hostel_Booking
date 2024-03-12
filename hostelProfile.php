<?php
session_start();
include "main_header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelid = isset($_SESSION['user_id']) ? $_SESSION['user_id']  :  '';
$hostelDetails = $UserController->gethostelsdetails($hostelid);
$hostel = $hostelDetails->fetch_assoc();

$complaints = $UserController->gethostelcomplaint($hostelid);
$inquerylist = $UserController->gethostelinquery($hostelid);
$hostellist = $UserController->gethostelInformation($hostelid);


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
                            <li><a href="#AddHostels" data-toggle="tab">Add Hostel</a></li>
                            <li><a href="#complaints" data-toggle="tab">Compalints</a></li>
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

                            <!-- Add Hostel TAB -->
                            <div id="AddHostels" class="tab-pane fade">
                                <h3>Add Hostel</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name </th>
                                            <th>Description </th>
                                            <th>location</th>
                                            <th>image</th>
                                            <th>amenities</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($hostel = $hostellist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $hostel['hostel_name'] ?></td>
                                                <td><?= $hostel['description'] ?></td>
                                                <td><?= $hostel['location'] ?></td>
                                                <td><img src="uploads/hostels/<?= $hostel['image'] ?>" alt="Hostel Image" width="70px;"></td>
                                                <td><?= $hostel['amenities'] ?></td>
                                                <td><?= $hostel['created_date'] ?></td>
                                                <td>
                                                    <a href="edit-hostel.php?id=<?= $hostel['id']; ?>" class="btn btn-sm btn-white text-primary me-2"><i class="far fa-edit me-1"></i> Edit</a>
                                                    <a href="javascript:;" onclick="deletehostel(<?= $hostel['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>

                                </table>
                                <a href="add-hostel.php" class="btn btn-primary">Add Hostel</a>
                                <a href="index.php" style="margin-left: 5px">Cancel</a>

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
                                            <th>Complaint ID</th>
                                            <th>Student Name </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($complaint = $complaints->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $complaint['id'] ?></td>
                                                <td><?= $complaint['student_name'] ?></td>
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


                            <!-- inquery TAB -->
                            <div id="Inquery" class="tab-pane fade">
                                <h3>Inquery List</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th>Student Name </th>
                                            <th>Email </th>
                                            <th>Contact NO</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($inquery = $inquerylist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $inquery['id'] ?></td>
                                                <td><?= $inquery['student_name'] ?></td>
                                                <td><?= $inquery['email'] ?></td>
                                                <td><?= $inquery['contact_no'] ?></td>
                                                <td><?= $inquery['description'] ?></td>
                                                <td><?= $inquery['created_date'] ?></td>
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

<script>
    function deletehostel(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "hostels.php?delateid=" + id;
        }
    }
</script>