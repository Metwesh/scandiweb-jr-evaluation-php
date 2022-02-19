<?php

require_once('includes/initialize.php');

require_once('productClass.php');

header('Content-Type: application/json; charset=UTF-8');



$response = array();

if (isset($_POST['sku']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['type']) && isset($_POST['description'])) {
    $class = $_POST['type'];
    $product = new $class($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['description']);

    $sku = $product->formatSKU($product->getType(), $product->getSKU());
    $name = $product->getName();
    $price = $product->getPrice();
    $type = $product->getType();
    $description = $product->formatDescription($product->getDesc());

    $result = $api->addProduct($sku, $name, $price, $type, $description);

    if ($result) {
        header("HTTP/1.1 200 OK");
        header("Location: https://metwesh.github.io/scandiweb-product-page/");
        exit();
    } else {
        header("HTTP/1.1 406 Error inserting product");
    }
} else {
    header("HTTP/1.1 422 Required parameters missing");
    echo 'Required parameters missing';
}
