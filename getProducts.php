<?php

require_once('includes/initialize.php');
require_once('classes/Validator.php');


$response = [];

$result = $api->getAllProducts();

Validator::checkEmptyResult($result);


header("HTTP/1.1 200 OK");
$response = $result;

echo json_encode($response);
