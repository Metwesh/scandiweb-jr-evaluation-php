<?php

class Api
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function findBySql($query)
    {
        $this->db->query($query);

        $set = $this->db->resultSet();

        return $set;
    }

    public function addProduct($prdt_sku, $prdt_name, $prdt_price, $prdt_type, $prdt_desc)
    {

        try {
            $this->db->query('INSERT INTO products(product_sku, product_name, product_price, product_type, product_desc) VALUES(:sku, :name, :price, :type, :description)');
            $this->db->bind(':sku', $prdt_sku);
            $this->db->bind(':name', $prdt_name);
            $this->db->bind(':price', $prdt_price);
            $this->db->bind(':type', $prdt_type);
            $this->db->bind(':description', $prdt_desc);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            header("HTTP/1.1 406 Error inserting product");
            header("refresh:3;url=https://metwesh.github.io/scandiweb-product-page/add-product");
            echo 'Product SKU already exists in database. Reirecting...';
        }
    }

    public function deleteProduct($prdt_sku)
    {
        try {
            $this->db->query("DELETE FROM products WHERE product_sku = :sku");
            $this->db->bind(":sku", $prdt_sku);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            header("HTTP/1.1 406 Error deleting product from database");
            header("refresh:3;url=https://metwesh.github.io/scandiweb-product-page/add-product");
            echo 'Error deleting product from database. Reirecting...';
        }
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";

        return $this->findBySql($query);
    }
}

$api = new Api();
