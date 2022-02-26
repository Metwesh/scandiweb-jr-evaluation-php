<?php

abstract class Product
{
    private $productSku;
    private $productName;
    private $productPrice;
    private $productType;
    private $productDesc;

    
    public function setSKU($productSku)
    {
        $this->productSku = $productSku;
    }
    public function setName($productName)
    {
        $this->productName = $productName;
    }
    public function setPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }
    public function setType($productType)
    {
        $this->productType = $productType;
    }
    public function setDesc($productDesc)
    {
        $this->productDesc = $productDesc;
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


    public function formatSKU($inputType, $inputSKU)
    {
        return strtoupper(substr($inputType, 0, 4)) . str_pad($inputSKU, 4, "0", STR_PAD_LEFT);
    }

    abstract protected function formatDescription($inputDesc);
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
        $implodedInput = implode('x', $inputDesc);
        return "Dimensions: " . $implodedInput;
    }
}
class Book extends Product
{
    public function formatDescription($inputDesc)
    {
        return "Weight: " . $inputDesc . "kg";
    }
}
