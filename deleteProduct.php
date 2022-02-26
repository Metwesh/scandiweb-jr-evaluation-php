<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');

$response = [];

Validator::checkEmptySKU($_POST['sku']);

$preFormatSKU = $_POST['sku'];

$sku = $product->formatDeleteSKU($preFormatSKU);

// $sku = "'" . join("','", $_POST['sku']) . "'";

$result = $api->deleteProduct($sku);

if (!$result) {
    header("HTTP/1.1 406 Error deleting product");
    exit();
}

header("HTTP/1.1 200 OK");
header("Location: https://scandiweb-product-page.herokuapp.com/");
