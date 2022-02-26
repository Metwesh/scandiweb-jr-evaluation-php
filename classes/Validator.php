<?php

class Validator
{
    private static $errors = [];

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function checkEmptyResult($result)
    {
        if (count($result) == 0) {
            header("HTTP/1.1 406 No products available");
            exit();
        }
    }

    public static function checkEmptySKU($sku)
    {
        if (!isset($sku)) {
            header("HTTP/1.1 422 Required parameters missing");
            header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/");
            echo 'Please select one or more of the checkboxes. Reirecting...';
            exit();
        }
    }

    public static function checkEmptyData($sku, $name, $price, $type, $description)
    {
        if (!isset($sku) | !isset($name) | !isset($price) | !isset($type) | !isset($description)) {
            header("HTTP/1.1 422 Required parameters missing");
            header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/add-product");
            echo 'Required parameters missing';
            exit();
        }
    }

    public static function validateData($sku, $name, $price, $description)
    {
        self::validateSKU($sku);
        self::validateName($name);
        self::validatePrice($price);
        self::validateDescription($description);
    }

    private function validateSKU($sku)
    {
        // 
    }

    private function validateName($name)
    {
        // 
    }

    private function validatePrice($price)
    {
        // 
    }

    private function validateDescription($description)
    {
        // 
    }
}

$validator = new Validator;
