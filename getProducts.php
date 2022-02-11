<?php

require_once('includes/initialize.php');


$response = array();

$result = $api->getAllProducts();

if (count($result) > 0) {
    header("HTTP/1.1 200 OK");
    $response = $result;
} else {
    header("HTTP/1.1 406 No products available");
}

echo json_encode($response);
