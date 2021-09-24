<?php

namespace App\Services;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

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

    public function getAll(): array
    {
        return History::all()->map(function ($history) {
            $aux = [];
            $aux['SKU'] = $history->SKU;
            $aux['action'] = $history->action;
            $aux['quantity'] = $history->quantity;
            $aux['date'] = $history->created_at;

            return $aux;
        })->toArray();
    }
}
