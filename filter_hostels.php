<?php
include "config/UserController.php";
$UserController = new UserController();

// Check if the request is AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['city_name'])) {
    try {
        $filteredHostels = $UserController->filterHostels($_POST['name'], $_POST['city_name']);

        echo json_encode($filteredHostels);
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
} else {
    echo json_encode(array('error' => 'Invalid request'));
}
?>
