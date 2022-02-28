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
        if (count($result) === 0) {
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
        is_array($description) ?
            self::validateArrayDescription($description) :
            self::validateDescription($description);
    }

    private function validateSKU($sku)
    {
        if (!ctype_alnum($sku)) {
            self::$errors += ['SKU' => 'SKU can only contain letters & numbers'];
        }
    }

    private function validateName($name)
    {
        echo $name;
        if (!ctype_alnum($name)) {
            self::$errors += ['Name' => 'Name can only contain letters & numbers'];
        }
    }

    private function validatePrice($price)
    {
        if (!is_numeric($price)) {
            self::$errors += ['Price' => 'Price can only contain numbers'];
        }
        Product::turnToFloat($price);
    }

    private function validateDescription($description)
    {
        if (!is_numeric($description)) self::$errors += ['Description' => 'Description can only contain numbers'];
    }

    private function validateArrayDescription($description)
    {
        foreach ($description as $key) {
            if (!is_numeric($key)) {
                self::$errors += ['Dimensions' => 'Dimensions can only contain numbers'];
                break;
            }
            Product::turnToFloat($key);
        }
        unset($key);
    }
}

$validator = new Validator;
