<?php

namespace CodeLabModul5\Models;

include "Config/DatabaseConfig.php";

use CodeLabModul5\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig
{
    public $conn;
    public function __construct()
    {
        $this -> conn = new mysqli($this->host,$this->user,$this->password,$this->db,$this->port);
        if ($this->conn->connect_error){
            die("Connection Failed : " . $this->conn->connect_error);
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    public function findAllCategory()
    {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    public function findCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function create($data)
    {
        $productName = $data['product_name'];

        $query = "INSERT INTO products (product_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s",$productName);
        $stmt->execute();
        $this->conn->close();
    }public function createCategories($data)
    {
        $productName = $data['category_name'];

        $query = "INSERT INTO categories (category_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s",$productName);
        $stmt->execute();
        $this->conn->close();
    }
    public function update($data, $id)
    {
        $productName = $data['product_name'];
        $categoryID = $data['category_id'];

        $query = "UPDATE products SET product_name = ?, category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sii", $productName, $categoryID, $id);
        $stmt->execute();
        $this->conn->close();
    }
    public function updateCategory($data, $id)
    {
        $productName = $data['category_name'];

        $query = "UPDATE categories SET category_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si",$productName,$id);
        $stmt->execute();
        $this->conn->close();
    }
    public function destroy($id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $this->conn->close();
    }
    public function destroyCategory($id)
    {
        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $this->conn->close();
    }

    public function findAllWithCategories()
    {
        $sql = "SELECT products.id, products.product_name, products.category_id, categories.category_name 
    FROM products 
    RIGHT JOIN categories ON products.category_id = categories.id";

        $result = $this->conn->query($sql);

        // Check for errors in the query execution
        if (!$result) {
            die("Error in SQL query: " . $this->conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Close the connection after fetching data
        $this->conn->close();

        // Return the response
//        return [
//            "code" => 200,
//            "message" => "success",
//            "data" => $data,
//        ];
        return $data;
    }
}