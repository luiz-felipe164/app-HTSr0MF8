<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->store($request->validated());

            if ($product) {
                return response()->json($product, 201);
            }

            throw new Exception("Error trying to save to database");
            
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred, please contact our support', 
                'code' => $e->getCode()], 500);
        }
    }

    public function update(ProductRequest $request)
    {
        try {
            $result = $this->productService->update($request->validated());

            if ($result['status']) {
                return response()->json(['quantity' => $result['quantity']], 200);
            }

            return response()->json($result, $result['code']);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred, please contact our support', 
                'code' => $e->getCode()], 500);
        }


    }
}
