<?php

require_once('includes/initialize.php');

require_once('classes/productClass.php');

header('Content-Type: application/json; charset=UTF-8');


$response = array();

if (!isset($_POST['sku']) | !isset($_POST['name']) | !isset($_POST['price']) | !isset($_POST['type']) | !isset($_POST['description'])) {
    header("HTTP/1.1 422 Required parameters missing");
    header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/add-product");
    echo 'Required parameters missing';
    exit();
}

$class = $_POST['type'];
$product = new $class();


$product->setSKU($_POST['sku']);
$product->setName($_POST['name']);
$product->setPrice($_POST['price']);
$product->setType($_POST['type']);
$product->setDesc($_POST['description']);


$sku = $product->formatSKU($product->getType(), $product->getSKU());
$name = $product->getName();
$price = $product->getPrice();
$type = $product->getType();
$description = $product->formatDescription($product->getDesc());

$result = $api->addProduct($sku, $name, $price, $type, $description);

if ($result) {
    header("HTTP/1.1 200 OK");
    header("Location: https://scandiweb-product-page.herokuapp.com/");
    exit();
} else {
    header("HTTP/1.1 406 Error inserting product");
}
