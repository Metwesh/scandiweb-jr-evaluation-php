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

$sku = "'" . join("','", $_POST['sku']) . "'";

$result = $api->deleteProduct($sku);

if (!$result) {
    header("HTTP/1.1 406 Error deleting product");
    exit();
}

header("HTTP/1.1 200 OK");
header("Location: https://scandiweb-product-page.herokuapp.com/");
