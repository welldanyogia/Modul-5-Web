<?php

namespace CodeLabModul5\Controllers;

include "Traits/ApiResponseFormatter.php";
include "Models/Product.php";

use CodeLabModul5\Models\Product;
use CodeLabModul5\Traits\ApiResponseFormatter;

class ProductController
{
    use ApiResponseFormatter;

    public function index()
    {
        $productModel = new Product();
        $response = $productModel->findAll();
        return $this->apiResponse(200,"success",$response);
    }
    public function indexCategory()
    {
        $productModel = new Product();
        $response = $productModel->findAllCategory();
        return $this->apiResponse(200,"success",$response);
    }

    public function getById($id)
    {
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->apiResponse(200,"success",$response);
    }
    public function getCategoryById($id)
    {
        $productModel = new Product();
        $response = $productModel->findCategoryById($id);
        return $this->apiResponse(200,"success",$response);
    }

    public function insert()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error : invalid input", null);
        }
            $productModel = new Product();
            $response = $productModel->create([
                "product_name" => $inputData['product_name'],
                "category_id" => $inputData['category_id']
            ]);
        return $this->apiResponse(200,"success", $response);
    }
    public function insertCategories()
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error : invalid input", null);
        }
            $productModel = new Product();
            $response = $productModel->createCategories([
                "category_name" => $inputData['category_name']
            ]);
        return $this->apiResponse(200,"success", $response);
    }
    public function update($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error : invalid input", null);
        }
            $productModel = new Product();
            $response = $productModel->update([
                "product_name" => $inputData['product_name'],
                "category_id" => $inputData['category_id']
            ],$id);
        return $this->apiResponse(200,"success", $response);
    }
    public function updateCategory($id)
    {
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);

        if (json_last_error()) {
            return $this->apiResponse(400, "error : invalid input", null);
        }
            $productModel = new Product();
            $response = $productModel->updateCategory([
                "category_name" => $inputData['category_name']
            ],$id);
        return $this->apiResponse(200,"success", $response);
    }
    public function delete($id)
    {
            $productModel = new Product();
            $response = $productModel->destroy($id);
        return $this->apiResponse(200,"success", $response);
    }
    public function deleteCategory($id)
    {
            $productModel = new Product();
            $response = $productModel->destroyCategory($id);
        return $this->apiResponse(200,"success", $response);
    }

    public function getProductsWithCategories()
    {
        $productModel = new Product;
        $response = $productModel->findAllWithCategories();

        return $this->apiResponse(200, "success", $response);
    }

}