

<?php

function showToast($message, $type = 'success') {
    echo "&nbsp;<script>";
    echo "toastr.{$type}('{$message}', '', { closeButton: true, progressBar: true });";
    echo "</script>";
}

function dd($data){
    echo "<pre>";
    print_r($data);
    die;
}
?>
