<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>HOME</title>


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



</head>
<style>
    .menu li.active a:after {
        content: "";
        height: 2px;
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        width: auto;
        background-color: #E1BD85;
        -webkit-animation: moveFromLeft 400ms ease;
        animation: moveFromLeft 400ms ease;
    }

    .error-message-red {
        color: red;
    }
</style>

<body>
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
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
                            <li <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                                <a href="index.php">Home</a>
                            </li>
                            <li <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>
                                <a href="about.php">About</a>
                            </li>
                            <li <?php if ($current_page == 'hostels.php') echo 'class="active"'; ?>>
                                <a href="hostels.php">HOSTELS</a>
                            </li>
                            <li <?php if ($current_page == 'contact.php') echo 'class="active"'; ?>>
                                <a href="contact.php">Contact</a>
                            </li>
                            <?php
                            if (isset($_SESSION['user_role'])) {
                                if ($_SESSION['user_role'] == 'student') {
                                    echo '<li ';
                                    if ($current_page == 'studentProfile.php') echo 'class="active"';
                                    echo '><a href="studentProfile.php">My Account</a></li>';
                                } elseif ($_SESSION['user_role'] == 'hostel') {
                                    echo '<li ';
                                    if ($current_page == 'hostelProfile.php') echo 'class="active"';
                                    echo '><a href="hostelProfile.php">My Account</a></li>';
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
