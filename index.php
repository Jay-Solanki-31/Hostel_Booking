<?php


include "index-header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelImages = $UserController->GetHostelData();
$sliders = $UserController->displaysliders();
?>
<style>
/* Define keyframes for text popup animation */
@keyframes textPopup {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Apply animation to slider description */
.slider-description {
    position: absolute;
    bottom: 300px;
    left: 40%;
    transform: translateX(-50%);
    color: white;
    font-size: 40px;
    text-align: center;
    z-index: 1000;
    animation: textPopup 0.5s ease-out forwards; /* Adjust duration and timing function as needed */
}

.slider-button {
    position: absolute;
    bottom: 250px; /* Adjust the distance from the bottom as needed */
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: wheat; /* Button background color */
    color: black; /* Button text color */
    font-size: 16px;
    text-align: center;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1000;
    transition: background-color 0.3s ease;
}

.slider-button:hover {
    background-color: yellowgreen; /* Button background color on hover */
}



       
    


</style>
<body>
    
<!-- BANNER SLIDER -->
<section class="section-slider slider-style-2 clearfix">
    <h1 class="element-invisible">Slider</h1>
    <div id="slider-revolution">
        <ul>
            <?php foreach ($sliders as $slider) : ?>
                <li data-transition="fade">
                    <img src="uploads/slider/<?php echo $slider->picture; ?>" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">
                    <div class="slider-description"><?php echo $slider->info; ?></div>
                    <a href="hostels.php" class="slider-button">View Hostels</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<!-- END / BANNER SLIDER -->

    <!-- ACCOMMODATIONS -->

    <section class="ot-accomd-modations">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-xs-12 col-lg-6 col-lg-offset-3">
                        <div class="ot-heading pt80 pb30 text-center row-20">
                            <h2 class="mb15">Our Top Recommendations</h2>
                            <p class="sub pr10 pl10">
                                Are you ready to embark on a journey filled with exciting adventures, new friendships, and unforgettable memories? Look no further than our curated selection of top-notch hostels that promise to elevate your travel experience without breaking the bank.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <?php
                        $counter = 0;
                        foreach ($hostelImages as $hostel) :
                            $hostelId = $hostel['id'];
                        ?>
                            <div class="col-xs-12 col-sm-4">
                                <div class="item room-item text-center accomd-modifications-room_1">
                                    <!-- Hostel image -->
                                    <div class="img">
                                        <!-- Set a fixed size for the image -->
                                        <a href="hostels-detail.php?id=<?php echo $hostelId; ?>"><img class="img-responsive img-full hostel-image" src="uploads/hostels/<?php echo $hostel['image']; ?>" alt="<?php echo $hostel['hostel_name']; ?>" style="width: 100%; height: 250px;"></a>
                                    </div>
                                    <!-- Hostel name -->
                                    <h2 class="title"><a href="hostels-detail.php?id=<?php echo $hostelId; ?>"><?php echo $hostel['hostel_name']; ?></a></h2>
                                    <div class="info upper">
                                        <a class="awe-btn awe-btn-default btn-medium font-hind f12 bold" href="hostels-detail.php?id=<?php echo $hostelId; ?>">View Details</a>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $counter++;
                            if ($counter % 3 == 0) {
                                echo '</div><div class="row">';
                            }
                        endforeach;
                        ?>
                    </div>
                </div>




            </div>
        </div>
    </section>

    <div class="text-center">
        <a href="hostels.php" class="awe-btn awe-btn-13">VIEW MORE</a>
    </div>

    </div>
    </div>
    </section>
    <!-- END / ACCOMMODATIONS -->

    <!-- HOSTEL FINDER -->
    <section class="hostel-finder mt60">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                        <div class="heading mb40 row-20 text-center">
                            <h2>HOSTEL FINDER</h2>
                            <p class="sub pr10 pl10">
                                Looking for a comfortable and affordable stay? Explore our selection of hostels
                                in popular destinations.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="img-hover-box mb40">
                    <div class="img">
                        <img class="img-responsive" src="images/slider/img-4.jpg" alt="">
                    </div>
                </div>
                <div class="text-center mt40 mb30 featured">
                    <p class="font-hind f-500 f20">Find the perfect hostel for your next adventure.</p>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        <div class="details">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <p class="font-hind f14 pr15">
                                        Whether you're a solo traveler or part of a group, our hostel finder makes it easy
                                        to discover budget-friendly accommodations. Search by location, price, amenities,
                                        and more.
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <p class="font-hind f14 pl15">
                                        With options available worldwide, you'll find hostels in bustling cities,
                                        scenic countryside, and everywhere in between. Start planning your trip today
                                        and book your stay with confidence.
                                    </p>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="hostels.php" class="btn btn-default mt30 mb30 font-hind f12 bold btn-medium">Explore Hostels</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / HOSTEL FINDER -->

    <!-- OUR BEST -->
    <section class="ot-out-best mt60">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                        <div class="ot-heading mb40 row-20 text-center">
                            <h2>Our best</h2>
                        </div>
                    </div>
                </div>
                <div class="owl-single owl-best" data-single_item="false" data-desktop="6" data-small_desktop="4" data-tablet="3" data-mobile="2" data-nav="true" data-pagination="false">
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-11.png" alt="icon">
                        <span class="font-hind f-500">Free Wifi</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-12.png" alt="icon">
                        <span class="font-hind f-500">Car Packing</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-13.png" alt="icon">
                        <span class="font-hind f-500">Service Room</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-14.png" alt="icon">
                        <span class="font-hind f-500">Air Conditioner</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-15.png" alt="icon">
                        <span class="font-hind f-500">Airtel Digital TV</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-16.png" alt="icon">
                        <span class="font-hind f-500">Luggage</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-12.png" alt="icon">
                        <span class="font-hind f-500">Car Packing</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-13.png" alt="icon">
                        <span class="font-hind f-500">Service Room</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-11.png" alt="icon">
                        <span class="font-hind f-500">Free Wifi</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-14.png" alt="icon">
                        <span class="font-hind f-500">Air Conditioner</span>
                    </div>
                    <div class="item text-center">
                        <img class="img-responsive mb10" src="images/home-3/icon/icon-15.png" alt="icon">
                        <span class="font-hind f-500">Airtel Digital TV</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / OUR BEST -->


    <?php include "index-footer.php" ?>