<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');


$response = array();

if (isset($_POST['sku'])) {

    $sku = $_POST['sku'];

    foreach ($sku as $deletables) {
        $result = $api->deleteProduct($deletables);
    }

    if ($result) {
        header("HTTP/1.1 200 OK");
        header("Location: http://localhost:3000/");
        exit();
    } else {
        header("HTTP/1.1 406 Error deleting product");
    }
} else {
    header("HTTP/1.1 499 Required parameters missing");
    echo "Please select one or more of the checkboxes. Reirecting...";
    header("refresh:3;url=http://localhost:3000/");
}
