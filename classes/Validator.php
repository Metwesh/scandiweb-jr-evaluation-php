<?php

abstract class Validator
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
        if (!isset($sku)) {
            echo '\n    SKU parameter missing';
        }
        if (!isset($name)) {
            echo '\n    Name parameter missing';
        }
        if (!isset($price)) {
            echo '\n    Price parameter missing';
        }
        if (!isset($type)) {
            echo '\n    Type parameter missing';
        }
        if (!isset($description)) {
            echo '\n    Description parameter(s) missing';
        }
        if (!isset($sku) | !isset($name) | !isset($price) | !isset($type) | !isset($description)) {
            header("HTTP/1.1 422 Required parameters missing");
            header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/add-product");
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
        if (!preg_match('/^[a-zA-Z\s\&]+$/', $name)) {
            self::$errors += ['Name' => 'Name can only contain letters & numbers'];
        }
    }

    private function validatePrice($price)
    {
        if (!is_numeric($price)) {
            self::$errors += ['Price' => 'Price can only contain numbers'];
        }
        if ($price < 0) {
            self::$errors += ['Price' => 'Price can only be a positive number'];
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
