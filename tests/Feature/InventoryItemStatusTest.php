<?php

namespace Tests\Feature;

use App\Models\InventoryItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryItemStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_status_is_derived_from_stock_quantity(): void
    {
        $this->assertSame('out_of_stock', $this->createItem(0)->status);
        $this->assertSame('low_stock', $this->createItem(5)->status);
        $this->assertSame('in_stock', $this->createItem(25)->status);
    }

    public function test_supplied_status_cannot_override_stock_quantity(): void
    {
        $item = InventoryItem::create([
            'item_name' => 'Test item',
            'sku' => 'TEST-STATUS',
            'location' => 'Akure',
            'quantity_in_stock' => 5,
            'unit_price' => 100,
            'status' => 'in_stock',
        ]);

        $this->assertSame('low_stock', $item->status);
    }

    private function createItem(int $quantity): InventoryItem
    {
        static $sequence = 0;

        return InventoryItem::create([
            'item_name' => 'Test item',
            'sku' => 'TEST-'.++$sequence,
            'location' => 'Akure',
            'quantity_in_stock' => $quantity,
            'unit_price' => 100,
        ]);
    }
}