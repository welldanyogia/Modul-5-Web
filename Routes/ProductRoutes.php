<?php

namespace CodeLabModul5\Routes;

include "Controllers/ProductController.php";

use CodeLabModul5\Controllers\ProductController;

class ProductRoutes
{
    public function handle($method,$path)
    {
        if ($method === 'GET' && $path === '/api/product'){
            $controller = new ProductController();
            echo $controller->index();
        }
        if ($method === 'GET' && $path === '/api/categories'){
            $controller = new ProductController();
            echo $controller->indexCategory();
        }
        if ($method === 'GET' && strpos($path, '/api/product/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->getById($id);
        }
        if ($method === 'GET' && strpos($path, '/api/categories/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->getCategoryById($id);
        }

        if ($method==='POST' && $path === '/api/products'){
            $controller = new ProductController();
            echo $controller->insert();
        }
        if ($method==='POST' && $path === '/api/categories'){
            $controller = new ProductController();
            echo $controller->insertCategories();
        }

        if ($method === 'PUT' && strpos($path, '/api/product/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->update($id);
        }
        if ($method === 'PUT' && strpos($path, '/api/categories/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->updateCategory($id);
        }

        if ($method === 'DELETE' && strpos($path, '/api/product/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->delete($id);
        }
        if ($method === 'DELETE' && strpos($path, '/api/categories/') === 0){
            $pathParts = explode('/',$path);
            $id = $pathParts[count($pathParts)-1];

            $controller = new ProductController();
            echo $controller->deleteCategory($id);
        }

        if ($method === 'GET' && strpos($path, '/api/product-categories')===0){
            $controller = new ProductController();
            echo $controller->getProductsWithCategories();
        }
    }
}