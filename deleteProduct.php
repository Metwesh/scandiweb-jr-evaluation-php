<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');

$response = array();

if (!isset($_POST['sku'])) {
    header("HTTP/1.1 422 Required parameters missing");
    header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/");
    echo 'Please select one or more of the checkboxes. Reirecting...';
    exit();
}

// $sku = trim(str_repeat(",?", count($_POST['sku'])), ",");


// $sku = implode(',', $_POST['sku']);
$sku = str_repeat('?,', count($_POST['sku']) - 1) . '?';

$result = $api->deleteProduct($sku);

// foreach ($sku as $deletables) {
//     $result = $api->deleteProduct($deletables);
// }

if (!$result) {
    header("HTTP/1.1 406 Error deleting product");
    exit();
}

header("HTTP/1.1 200 OK");
// header("Location: https://scandiweb-product-page.herokuapp.com/");
