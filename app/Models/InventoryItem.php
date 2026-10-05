<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryItemFactory> */
    use HasFactory;

    protected $fillable = [
        'item_name',
        'sku',
        'image_path',
        'location',
        'quantity_in_stock',
        'unit_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity_in_stock' => 'integer',
            'unit_price' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (InventoryItem $item): void {
            $item->status = match (true) {
                $item->quantity_in_stock <= 0 => 'out_of_stock',
                $item->quantity_in_stock <= 10 => 'low_stock',
                default => 'in_stock',
            };
        });
    }
}
