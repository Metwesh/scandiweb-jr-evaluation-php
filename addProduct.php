<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');


$response = [];

Validator::checkEmptyData($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['description']);

Validator::validateData($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['description']);

$errors = Validator::getErrors();


if ($errors) {
    echo "Errors: \n";
    foreach ($errors as $key => $value) {
        echo "{$key} => {$value} \n";
    }
    unset($key, $value);
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

if (!$result) {
    header("HTTP/1.1 406 Error inserting product");
    exit();
}

header("HTTP/1.1 200 OK");
header("Location: https://scandiweb-product-page.herokuapp.com/");
