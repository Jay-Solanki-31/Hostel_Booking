<?php
 
    // print_r($_POST);
    if(isset($_POST['action']) && $_POST['action'] == "assign_hostel"){

        include "UserController.php";
        $UserController = new UserController();

        $UserController->assignHostel();

    }

?>