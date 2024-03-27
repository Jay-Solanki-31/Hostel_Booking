<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <?php
    $page_titles = array(
        "about.php" => "ABOUT US",
        "contact.php" => "CONTACT US",
        "hostels.php" => "HOSTELS",
        "login.php" => "LOGIN",
        "register.php" => "REGISTER",
        "hostels-detail.php" => "HOSTELS DETAILS ",
        "studentProfile.php" => "PROFILE",
        "hostelProfile.php" => "PROFILE",

    );

    // Get the current page filename
    $current_page = basename($_SERVER['PHP_SELF']);

    // Check if the current page exists in the $page_titles array, if not, default to "Untitled"
    $title = isset($page_titles[$current_page]) ? $page_titles[$current_page] : "Untitled";

    // Echo the dynamic title
    echo "<title>$title</title>";
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="images/favicon.png" />

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700" rel='stylesheet' type='text/css'>

    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/font-lotusicon.css">
    <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="css/lib/settings.css">
    <link rel="stylesheet" type="text/css" href="css/lib/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dCW/rbsauwUKzs2vBgOpkYZWZdOZ9dQT4vn9tn7C8MPwCuE7U80I8+3wBlgxJWKSk4tmS5gY8V5Nt4lzGv7ZCg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<style>
    .menu li.active a {
    color: goldenrod;

    .error-message-red {
    color: red;
}

}

</style>

<body>

    <!-- PRELOADER -->
    <!-- <div id="preloader">
        <span class="preloader-dot"></span>
    </div> -->
    <!-- END / PRELOADER -->

    <!-- PAGE WRAP -->
    <div id="page-wrap">

        <!-- HEADER -->
        <header id="header">

            <!-- HEADER TOP -->
            <div class="header_top">
                <div class="container">
                    <div class="header_right float-right">

                    </div>
                </div>
            </div>
            <!-- END / HEADER TOP -->

            <!-- HEADER LOGO & MENU -->
            <div class="header_content" id="header_content">

                <div class="container">
                    <!-- HEADER LOGO -->
                    <div class="header_logo">
                        <a href="index.php"><img src="images/logo-header.png" alt=""></a>
                    </div>
                    <!-- END / HEADER LOGO -->
                    <!-- HEADER MENU -->
                    <nav class="header_menu">
                        <ul class="menu">
                            <li <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                                <a href="index.php">Home</a>
                            </li>
                            <li <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>
                                <a href="about.php">About</a>
                            </li>
                            <li <?php if ($current_page == 'hostels.php' || $current_page == 'hostels-detail.php' || $current_page == 'hostelProfile.php') echo 'class="active"'; ?>>
                                <a href="hostels.php">Hostels</a>
                            </li>
                            <li <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>
                                <a href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- END / HEADER MENU -->


                    <!-- MENU BAR -->
                    <span class="menu-bars">
                        <span></span>
                    </span>
                    <!-- END / MENU BAR -->

                </div>
            </div>
            <!-- END / HEADER LOGO & MENU -->

        </header>
        <!-- END / HEADER -->