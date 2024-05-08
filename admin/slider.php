<?php

session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

require "main_header.php";


include "../config/AdminController.php";
$AdminController = new AdminController();
$sliderList = $AdminController->get_slider();

$delateid = isset($_GET['delateid']) ? $_GET['delateid']  :  '';
if ($delateid) {
    $delateSlider = $AdminController->deleteSlider($delateid);
}
?>
<?php require "main_sidebar.php"; ?>


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Slider</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Add Slider</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="add-slider.php" class="btn btn-primary me-1">
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
                                <table class="table table-center table-hover datatable text-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Description</th>
                                            <th>Picture</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $sliderList->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['info']; ?></td>
                                                <td><img src="../uploads/slider/<?= $row['picture']; ?>" style="width:50%;height:30%;" /></td>
                                                <td>
                                                <a href="edit-slider.php?id=<?= $row['id']; ?>"class="btn btn-sm btn-white text-success me-2"><i class="far fa-edit me-1"></i> Edit</a>
                                                    <a href="javascript:;" onclick="deleteSlider(<?= $row['id']; ?>)" class="btn btn-sm btn-white text-danger me-2"><i class="far fa-trash-alt me-1"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
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
    function deleteSlider(id) {
        // alert(id);
        let conform = window.confirm("Are you sure want to delete this record?");
        if (conform) {
            // alert('delated');
            window.location.href = "sliders.php?delateid=" + id;
        }
    }
</script>