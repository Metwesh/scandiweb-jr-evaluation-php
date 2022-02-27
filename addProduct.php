<?php

require_once('includes/initialize.php');

header('Content-Type: application/json; charset=UTF-8');


$response = [];

Validator::checkEmptyData($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['description']);

$inputSKU = Product::trimData($_POST['sku']);
$inputName = Product::trimData($_POST['name']);
$inputPrice = Product::trimData($_POST['price']);
$inputType = $_POST['type'];
$inputDesc = Product::trimArray($_POST['description']);

Validator::validateData($inputSKU, $inputName, $inputPrice, $inputDesc);

$errors = Validator::getErrors();

if ($errors) {
    echo "\n    Error(s): \n\n\n";
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
