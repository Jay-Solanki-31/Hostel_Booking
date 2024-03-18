<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
} 
 

require "main_header.php"; 
include "../config/AdminController.php";
$AdminController = new AdminController();
$hostellist = $AdminController->get_hostel();

$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if($delateid){
$delatehostel = $AdminController->delatehostel($delateid);
}
require "main_sidebar.php"; 
?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Hostels</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Hostels</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="add-hostel.php" class="btn btn-primary me-1">
                            <i class="fas fa-plus"></i>
                        </a>
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
                                            <th>Picture</th>
                                            <th> Name </th>
                                            <th>Description</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Created on</th>
                                            <th>Modified On</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $hostellist->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><img src="../uploads/hostels/<?= $row['image']; ?>"  style="width:80%;"/></td>
                                           
                                                <td> <?= $row['hostel_name']; ?> </td>
                                                <td><?= strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description']; ?></td>

                                                <td><?= $row['location']; ?></td>
                                                <td>
                                                    <?= $row['status'] == 1 ? '<span class="badge badge-pill bg-success-light">Active</span>' : '<span class="badge badge-pill bg-danger-light">Inactive</span>'; ?>
                                                </td>
                                                <td><?= $row['created_date']; ?> </td>
                                                <td><?= $row['modified_date']; ?> </td>
                                                <td>
                                                    <a href="edit-hostel.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a>
                                                    <a href="javascript:;" onclick="deletehostel(<?= $row['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
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


<?php require "main_footer.php"; ?>

<script>
   function deletehostel(id){
    // alert(id);
    let conform = window.confirm("Are you sure want to delete this record?");
     if(conform){
        // alert('delated');
        window.location.href = "hostels.php?delateid="+id;
     }
   }
</script>