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

    public function addProduct($product_sku, $product_name, $product_price, $product_type, $product_desc)
    {

        try {
            $this->db->query('INSERT INTO products(product_sku, product_name, product_price, product_type, product_desc) VALUES(:sku, :name, :price, :type, :description)');
            $this->db->bind(':sku', $product_sku);
            $this->db->bind(':name', $product_name);
            $this->db->bind(':price', $product_price);
            $this->db->bind(':type', $product_type);
            $this->db->bind(':description', $product_desc);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            header("HTTP/1.1 406 Error inserting product");
            header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/add-product");
            echo 'Product SKU already exists in database. Reirecting...';
            exit;
        }
    }

    public function deleteProduct($product_sku)
    {
        try {
            $this->db->query("DELETE FROM products WHERE product_sku IN :sku");
            $this->db->bind(":sku", $product_sku);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            header("HTTP/1.1 406 Error deleting product from database");
            header("refresh:3;url=https://scandiweb-product-page.herokuapp.com/");
            echo 'Error deleting product from database. Reirecting...';
            exit;
        }
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM products";

        return $this->findBySql($query);
    }
}

$api = new Api();
