<?php 
session_start();
function isLoggedIn() {
    return isset($_SESSION['user_email']) && isset($_SESSION['user_role']) && isset($_SESSION['user_id']);
}

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
include "main_header.php";
include "config/UserController.php";

if (isset($_GET['id'])) {
    $hostelId = $_GET['id'];
    // echo "<p>Hostel ID: $hostelId</p>";
} 

$UserController = new UserController();
$hostelData = $UserController->get_hostel();
?>
<section class="section-sub-banner bg-16">
    <div class="awe-overlay"></div>
    <div class="sub-banner">
        <div class="container">
            <div class="text text-center">
                <h2>HOSTEL IMFORMATION </h2>
            </div>
        </div>

    </div>

</section>
<!-- END / SUB BANNER -->

<!-- ROOM DETAIL -->
<section class="section-room-detail bg-white">
    <div class="container">
        <div class="room-wrap-5">

            <!-- DETAIL -->
            <div class="room-detail">
                <div class="row">
                    <div class="col-lg-9">

                        <!-- LAGER IMGAE -->
                        <div class="room-detail_img">
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-1.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-2.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-3.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-5.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-6.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-7.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                            <div class="room_img-item">
                                <img src="images/room/detail/lager/img-5.jpg" alt="">
                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h6>
                            </div>
                        </div>
                        <!-- END / LAGER IMGAE -->


                    </div>

                    <div class="col-lg-3">

                        <!-- FORM BOOK -->
                        <div class="room-detail_book">

                            <div class="room-detail_total">
                                <img src="images/icon-logo.png" alt="" class="icon-logo">

                                <h5>Inquery Now </h5>

        
                            </div>

                            <div class="room-detail_form">
                                <label>Name</label>
                                <input type="text"  placeholder="Enter Your Name ">
                                <label>Email</label>
                                <input type="email"  placeholder="Enter your Email">
                                <label>Phone No </label>   
                                <input type="text"  placeholder="Enter Your Contact No">
                                <label>Description</label>   
                                <input type="text"  placeholder="Enter Your Desciption">          
                                <button class="awe-btn awe-btn-13">Inquery Now</button>
                            </div>

                        </div>
                        <!-- END / FORM BOOK -->

                    </div>
                </div>
            </div>
            <!-- END / DETAIL -->

            <!-- TAB -->
            <div class="room-detail_tab">

                <div class="row">
                    <div class="col-md-3">
                        <ul class="room-detail_tab-header">
                            <li><a href="#overview" data-toggle="tab">OVERVIEW</a></li>
                            <li class="active"><a href="#amenities" data-toggle="tab">amenities</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="room-detail_tab-content tab-content">

                            <!-- OVERVIEW -->
                            <div class="tab-pane fade" id="overview">

                                <div class="room-detail_overview">
                                    <h5 class='text-uppercase
                                        '>de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h5>
                                    <p>Located in the heart of Aspen with a unique blend of contemporary luxury and historic heritage, deluxe accommodations, superb amenities, genuine hospitality and dedicated service for an elevated experience in the Rocky Mountains.</p>

                                    <div class="row">
                                        <div class="col-xs-6 col-md-4">
                                            <h6>SPECIAL ROOM</h6>
                                            <ul>
                                                <li>Max: 4 Person(s)</li>
                                                <li>Size: 35 m2 / 376 ft2</li>
                                                <li>View: Ocen</li>
                                                <li>Bed: King-size or twin beds</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                            <h6>SERVICE ROOM</h6>
                                            <ul>
                                                <li>Oversized work desk</li>
                                                <li>Hairdryer</li>
                                                <li>Iron/ironing board upon request</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- END / OVERVIEW -->

                            <!-- AMENITIES -->
                            <div class="tab-pane fade active in" id="amenities">

                                <div class="room-detail_amenities">
                                    <p>Located in the heart of Aspen with a unique blend of contemporary luxury and historic heritage, deluxe accommodations, superb amenities, genuine hospitality and dedicated service for an elevated experience in the Rocky Mountains.</p>

                                    <div class="row">
                                        <div class="col-xs-6 col-lg-4">
                                            <h6>LIVING ROOM</h6>
                                            <ul>
                                                <li>Oversized work desk</li>
                                                <li>Hairdryer</li>
                                                <li>Iron/ironing board upon request</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- END / AMENITIES -->
                        </div>
                    </div>

                </div>

            </div>
            <!-- END / TAB -->

      
        </div>
</section>

<?php include "main_footer.php" ?>