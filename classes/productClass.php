<?php

abstract class Product
{
    private $prodSku;
    private $prodName;
    private $prodPrice;
    private $prodType;
    private $prodDesc;

    public function __construct($prodSku, $prodName, $prodPrice, $prodType, $prodDesc)
    {
        $this->prodSku = $prodSku;
        $this->prodName = $prodName;
        $this->prodPrice = $prodPrice;
        $this->prodType = $prodType;
        $this->prodDesc = $prodDesc;
    }

    public function getSKU()
    {
        return $this->prodSku;
    }
    public function getName()
    {
        return $this->prodName;
    }
    public function getPrice()
    {
        return $this->prodPrice;
    }
    public function getType()
    {
        return $this->prodType;
    }
    public function getDesc()
    {
        return $this->prodDesc;
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
