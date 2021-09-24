<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    private $historyService;

    public function __construct(HistoryProductService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function store(array $data): Product
    {
        return Product::create($data);
    }

    public function update(array $data): array
    {
        $product = Product::where('SKU', $data['SKU'])->first();

        if (!$product) {
            return ['status' => false, 'message' => 'Product not found', 'code' => 404];
        }

        $newQuantity = $data['action'] === 'add' ?
            $product->quantity + $data['quantity'] :
            $product->quantity - $data['quantity'];

        if ($newQuantity < 0) {
            return ['status' => false, 'message' => 'The product cannot have a quantity less than zero', 'code' => 500];
        }

        $product->quantity = $newQuantity;
        $product->save();

        $this->historyService->store($data['action'], $data['quantity'], $product->SKU);

        return ['status' => true, 'quantity' => $newQuantity];
    }
}
