<?php

interface Formatter
{
    public function formatDescription($inputDesc);
}

abstract class Product implements Formatter
{
    private $productSku;
    private $productName;
    private $productPrice;
    private $productType;
    private $productDesc;


    public function setSKU($productSku)
    {
        $this->productSku = trim($productSku);
    }
    public function setName($productName)
    {
        $this->productName = trim($productName);
    }
    public function setPrice($productPrice)
    {
        $this->productPrice = trim($productPrice);
    }
    public function setType($productType)
    {
        $this->productType = trim($productType);
    }
    public function setDesc($productDesc)
    {
        $this->productDesc = trim($productDesc);
    }


    public function getSKU()
    {
        return $this->productSku;
    }
    public function getName()
    {
        return $this->productName;
    }
    public function getPrice()
    {
        return $this->productPrice;
    }
    public function getType()
    {
        return $this->productType;
    }
    public function getDesc()
    {
        return $this->productDesc;
    }

    public static function formatDeleteSKU($inputSKU)
    {
        return "'" . join("','", $inputSKU) . "'";
    }

    public function formatSKU($inputType, $inputSKU)
    {
        return strtoupper(substr($inputType, 0, 4)) . str_pad($inputSKU, 4, "0", STR_PAD_LEFT);
    }
}

class DVD extends Product
{
    public function formatDescription($inputDesc)
    {
        return "Size: " . $inputDesc . "MB";
    }
}
class Furniture extends Product
{
    public function formatDescription($inputDesc)
    {
        foreach ($inputDesc as $input) {
            return trim($input);
        }
        return "Dimensions: " . implode('x', $inputDesc);
    }
}
class Book extends Product
{
    public function formatDescription($inputDesc)
    {
        return "Weight: " . $inputDesc . "kg";
    }
}
