<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>Index</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="images/favicon.png" />

   
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,300,500,600%7cMontserrat:400,700" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">

    <!-- CSS LIBRARY -->
    <link rel="stylesheet" type="text/css" href="css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/font-lotusicon.css">
    <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="css/lib/settings.css">
    <link rel="stylesheet" type="text/css" href="css/lib/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/helper.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



</head>

<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <span class="preloader-dot"></span>
    </div>
    <!-- END / PRELOADER -->

    <div id="page-wrap" class="bg-white-2">
        <!-- HEADER -->
        <header id="header" class="header-v3 clearfix">

            <!-- HEADER TOP -->
            <div class="header_top">
                <div class="container">

                    <div class="header_right float-right">
                        <?php
                        session_start();
                        if (isset($_SESSION['user_email'])) {
                        ?>
                        <?php
                        } else {
                        ?>
                            <span class="login-register">
                                <a href="login.php">Login</a>
                                <a href="register.php">Register</a>
                            </span>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- HEADER LOGO -->
                    <a class="logo-top img-responsive" href="index.php"><img src="images/logo-header.png" alt=""></a>
                    <!-- END / HEADER LOGO -->

                </div>
            </div>
            <!-- END / HEADER TOP -->

            <!-- HEADER LOGO & MENU -->
            <div class="header_content" id="header_content">
                <div class="container">
                    <!-- HEADER MENU -->
                    <nav class="header_menu">
                        <ul class="menu">
                            <li class="current-menu-item">
                                <a href="index.php">Home</a>
                            </li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="hostels.php">HOSTELS</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php
                            if (isset($_SESSION['user_role'])) {
                                if ($_SESSION['user_role'] == 'student') {
                                    echo '<li><a href="studentProfile.php">My Account</a></li>';
                                } elseif ($_SESSION['user_role'] == 'hostel') {
                                    echo '<li><a href="hostelProfile.php">My Account</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </nav>

                    <!-- END / HEADER MENU -->


                </div>
            </div>
            <!-- END / HEADER LOGO & MENU -->

        </header>
        <!-- END / HEADER -->

    </div>

</body>

</html>