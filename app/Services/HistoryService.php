<?php

namespace App\Services;

use App\Models\History;

class HistoryProductService
{
    public function store(string $action, int $quantity, string $sku): void
    {
        History::create([
            'SKU' => $sku,
            'quantity' => $quantity,
            'action' => $action
        ]);
    }

}
