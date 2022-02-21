<?php

require_once('includes/initialize.php');


$response = array();

$result = $api->getAllProducts();

if (count($result) === 0) {
    header("HTTP/1.1 406 No products available");
    exit();
}

header("HTTP/1.1 200 OK");
$response = $result;

echo json_encode($response);
