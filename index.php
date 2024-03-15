<?php


include "index-header.php";
include "config/UserController.php";
$UserController = new UserController();
$hostelImages = $UserController->GetHostelData();
$sliders = $UserController->displaysliders();
?>

<body>

    <!-- BANNER SLIDER -->
    <section class="section-slider slider-style-2 clearfix">
        <h1 class="element-invisible">Slider</h1>
        <div id="slider-revolution">
            <ul>
                <?php foreach ($sliders as $slider) : ?>
                    <li data-transition="fade">
                        <img src="uploads/slider/<?php echo $slider->picture; ?>" data-bgposition="left center" data-duration="14000" data-bgpositionend="right center" alt="">

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
                        <a href="hostel-detail.php?id=<?php echo $hostelId; ?>"><img class="img-responsive img-full hostel-image" src="uploads/hostels/<?php echo $hostel['image']; ?>" alt="<?php echo $hostel['hostel_name']; ?>" style="width: 100%; height: 250px;"></a>
                    </div>
                    <!-- Hostel name -->
                    <h2 class="title"><a href="hostel-detail.php?id=<?php echo $hostelId; ?>"><?php echo $hostel['hostel_name']; ?></a></h2>
                    <div class="info upper">
                        <a class="awe-btn awe-btn-default btn-medium font-hind f12 bold" href="hostel-detail.php?id=<?php echo $hostelId; ?>">View Details</a>
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
        <a href="hostel.php" class="awe-btn awe-btn-13">VIEW MORE</a>
    </div>

    </div>
    </div>
    </section>
    <!-- END / ACCOMMODATIONS -->

    <!-- ABOUT -->
    <section class="ot-about mt60">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col col-xs-12 col-lg-6 col-lg-offset-3">
                        <div class="ot-heading mb40 row-20 text-center">
                            <h2>ABOUT LOTUS HOSTEL</h2>
                            <p class="sub pr10 pl10">

                                "Where Every Adventure Begins: Your Home Away from Home!"
                            </p>
                        </div>
                    </div>
                </div>
                <div class="img-hover-box mb40">
                    <div class="img">
                        <img class="img-responsive" src="assets/pexels-adrian-falcon-3359250 (1).jpg" alt="">
                    </div>
                </div>
                <div class="text-center mt40 mb30 featured">
                    <p class="font-hind f-500 f20">At our student-friendly hostel, we cater to a vibrant community of young explorers and scholars. From solo student travelers to groups seeking affordable accommodations, our hostel is the perfect hub for academic adventures and social connections. </p>
                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <div class="details">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <p class="font-hind f14 pr15">
                                            Our hostel offers convenient booking options for travelers arriving at various airports. You can book your stay directly upon arrival at Chicago O’Hare International Airport, Los Angeles International Airport, New York City's JFK International Airport, Newark International Airport, and San Francisco International Airport. These airports are primary hubs for travelers arriving from different parts of the world, ensuring easy access to our hostel accommodations. Rest assured, our hostel staff is ready to assist you in making your stay comfortable and enjoyable.
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p class="font-hind f14 pl15">
                                            Experience hassle-free booking with our hostel! We are partnered with the Centers for Disease Control & Prevention (CDC) to ensure the safety of our guests. Travelers arriving at airports directly from Hong Kong, Guangdong Province (People’s Republic of China), and Hanoi, Vietnam, are provided with information cards warning about potential health risks. At our hostel, we prioritize the well-being of our guests and maintain strict hygiene protocols to create a safe and welcoming environment for all travelers.
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <!-- END / ABOUT -->

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

    <!-- HOME GUEST BOOK -->
    <div class="section-home-guestbook home-guestbook-style-2 awe-parallax bg-22 mt90 pt100 pb100">
        <div class="container">
            <div class="home-guestbook pt0 pb0">
                <div class="row">
                    <div class="col-xs-12 col-lg-6 col-lg-offset-3">
                        <div class="ot-heading mb40 row-20 text-center">
                            <h2>Guest book</h2>
                            <p class="sub">Your feedback means the world to us.</p>
                        </div>
                    </div>
                    <div class="guestbook-content text-center owl-single">
                        <!-- ITEM -->
                        <div class="guestbook-item">
                            <div class="text">
                                <p class="f20">"This is the only place to stay in Catalina! I have stayed in the
                                    cheaper hotels and they were fine, but this is just the icing on the cake! After
                                    spending the day bike riding and hiking to come back and enjoy a glass of wine
                                    while looking out your ocean view window and then to top it all off"</p>
                            </div>
                            <div class="img">
                                <img src="images/avatar/img-15.png" alt="">
                            </div>
                            <div class="info-author">
                                <span class="f20 c-main"><strong>Rosalind Cloer</strong></span><br>
                                <span class="f14">Oxford</span>
                            </div>
                        </div>
                        <!-- ITEM -->
                        <!-- ITEM -->
                        <div class="guestbook-item">
                            <div class="text">
                                <p class="f20">This is the only place to stay in Catalina! I have stayed in the
                                    cheaper hotels and they were fine, but this is just the icing on the cake! After
                                    spending the day bike riding and hiking to come back and enjoy a glass of wine
                                    while looking out your ocean view window and then to top it all off...</p>
                            </div>
                            <div class="img">
                                <img src="images/avatar/img-5.jpg" alt="">
                            </div>
                            <div class="info-author">
                                <span class="f20 c-main"><strong>Seelentag</strong></span><br>
                                <span class="f14">From Los Angeles, California</span>
                            </div>
                        </div>
                        <!-- ITEM -->
                        <!-- ITEM -->
                        <div class="guestbook-item">
                            <div class="text">
                                <p class="f20">This is the only place to stay in Catalina! I have stayed in the
                                    cheaper hotels and they were fine, but this is just the icing on the cake! After
                                    spending the day bike riding and hiking to come back and enjoy a glass of wine
                                    while looking out your ocean view window and then to top it all off...</p>
                            </div>
                            <div class="img">
                                <img src="images/avatar/img-5.jpg" alt="">
                            </div>
                            <div class="info-author">
                                <span class="f20 c-main"><strong>Seelentag</strong></span><br>
                                <span class="f14">From Los Angeles, California</span>
                            </div>
                        </div>
                        <!-- ITEM -->

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- END / HOME GUEST BOOK -->

    <?php include "index-footer.php" ?>