<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
} 

require "main_header.php";

include "../config/AdminController.php";
$AdminController = new AdminController();
$InqueryList = $AdminController->DisplayInquery();


$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if ($delateid) {
    $deleteinquery = $AdminController->DeleteBookingInquery($delateid);
}
?>
<?php require "main_sidebar.php"; ?>


    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">All Bookings</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">All Bookings</li>
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
                                                <th>Name </th>
                                                <th>Email </th>
                                                <th>Contact No</th>
                                                <th>Description</th>
                                                <th>Created date</th>
                                                <th>Modified_date</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = $InqueryList->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>                                           
                                                <td> <?= $row['name']; ?> </td>
                                                <td><?= $row['email']; ?></td>
                                                <td><?= $row['contact_no']; ?></td>
                                                <td><?= $row['description']; ?></td>
                                                <td><?= $row['created_date']; ?> </td>
                                                <td><?= $row['modified_date']; ?> </td>
                                                <td>
                                                    <a href="javascript:;" onclick="DeleteBookingInquery(<?= $row['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
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

    <?php require "main_footer.php"; ?>

    <script>
    function DeleteBookingInquery(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "booking_inquiries.php?delateid=" + id;
        }
    }
</script>
