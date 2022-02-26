<?php

require_once('includes/initialize.php');


header('Content-Type: application/json; charset=UTF-8');

$response = [];

Validator::checkEmptySKU($_POST['sku']);



// $sku = "'" . join("','", $_POST['sku']) . "'";

$result = $api->deleteProduct($product->formatDeleteSKU($_POST['sku']));

if (!$result) {
    header("HTTP/1.1 406 Error deleting product");
    exit();
}

header("HTTP/1.1 200 OK");
header("Location: https://scandiweb-product-page.herokuapp.com/");
