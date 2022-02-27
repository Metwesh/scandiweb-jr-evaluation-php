<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');


$response = [];


$inputSKU = trim($_POST['sku'], " ");
$inputName = trim($_POST['name'], " ");
$inputPrice = trim($_POST['price'], " ");
$inputType = $_POST['type'];
$inputDesc = Product::trimData($_POST['description']);

Validator::checkEmptyData($inputSKU, $inputName, $inputPrice, $inputType, $inputDesc);

Validator::validateData($inputSKU, $inputName, $inputPrice, $inputType, $inputDesc);

$errors = Validator::getErrors();

if ($errors) {
    echo "\n    Errors: \n\n\n";
    foreach ($errors as $key => $value) {
        echo "      {$key} => {$value} \n\n";
    }
    unset($key, $value);
    exit();
}


$product = new $inputType();

$product->setSKU($inputSKU);
$product->setName($inputName);
$product->setPrice($inputPrice);
$product->setType($inputType);
$product->setDesc($inputDesc);


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
