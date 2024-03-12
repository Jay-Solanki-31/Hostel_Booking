<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
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
require "main_header.php";
include "../config/AdminController.php";
$AdminController = new AdminController();
$complaintlist = $AdminController->DisplayCompalins();


$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if ($delateid) {
    $deletecomplaint = $AdminController->Deletecomplaint($delateid);
}

$formName = isset($_POST['formName']) ? $_POST['formName']  :  '';
if ($formName && $formName == "complaintStatus") {
    $AdminController->updatecomplaintStatus();
}



?>
<?php require "main_sidebar.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Complaints</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Complaints</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sr No</th>
                                            <th> Student Name </th>
                                            <th> Hostel Name </th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created on</th>
                                            <th>Modified On</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $complaintlist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td> <?= $row['full_name']; ?> </td>
                                                <td> <?= $row['hostel_name']; ?> </td>
                                                <td><?= $row['description']; ?></td>
                                                <td>
                                                    <?php foreach ($complaintStatus as $status) : ?>
                                                        <?php if ($status['value'] == $row['status']) : ?>
                                                            <button type="button" class="btn btn-sm <?= $status['color']; ?>" onclick="openEditStatusModal(<?= $row['id']; ?>, <?= $status['value']; ?>, '<?= $status['status']; ?>')">
                                                                <?= $status['status']; ?>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>

                                                <td><?= $row['created_date']; ?></td>
                                                <td><?= $row['modified_date']; ?></td>
                                                <td>
                                                    <a href="javascript:;" onclick="Deletecomplaint(<?= $row['id']; ?>)" class="btn btn-sm btn-white text-danger me-2">
                                                        <i class="far fa-trash-alt me-1"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile;  ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Complaint Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<?php require "main_footer.php"; ?>

<script>
    function Deletecomplaint(id) {
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            window.location.href = "complaint.php?delateid=" + id;
        }
    }

    function openEditStatusModal(id, currentStatusValue, currentStatusText) {
        $('#complaintId').val(id);
        $('#newStatus').val(currentStatusValue);
        // $('#currentStatus').text('Current Status: ' + currentStatusText);
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