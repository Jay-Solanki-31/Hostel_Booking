<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

require "main_header.php";
require "main_sidebar.php";

?>

<body>

    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Rooms Assign</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Rooms Assign</li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                                <i class="fas fa-filter"></i>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Hostel Name </th>
                                                <th>Contact No</th>
                                                <th>Created on</th>
                                                <th>Modified On</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>

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
</body>