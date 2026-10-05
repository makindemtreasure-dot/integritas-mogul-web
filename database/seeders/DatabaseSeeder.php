<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CapitalRecord;
use App\Models\InventoryItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@integritas.test'], [
            'name' => 'INTEGRITAS MOGUL Administrator',
            'password' => 'password',
        ]);

        $inventory = [
            ['Akure', 'Cocoa Beans', 'AK-CB-001', 48, 18500],
            ['Akure', 'Cassava Flour', 'AK-CF-002', 8, 7200],
            ['Akure', 'Palm Oil 5L', 'AK-PO-003', 0, 12500],
            ['Akure', 'Maize Grain', 'AK-MG-004', 32, 9500],
            ['Akure', 'Shea Butter', 'AK-SB-005', 5, 14800],
            ['Akure', 'Dried Ginger', 'AK-DG-006', 17, 11200],
            ['Ifo', 'Rice 50kg', 'IF-RI-001', 26, 89500],
            ['Ifo', 'Beans 25kg', 'IF-BN-002', 4, 43500],
            ['Ifo', 'Garri 10kg', 'IF-GA-003', 0, 15700],
            ['Ifo', 'Plantain Flour', 'IF-PF-004', 19, 13800],
            ['Ifo', 'Groundnut Oil 5L', 'IF-GO-005', 10, 16400],
            ['Ifo', 'Honey 1L', 'IF-HO-006', 14, 9800],
        ];

        foreach ($inventory as [$location, $name, $sku, $quantity, $price]) {
            InventoryItem::updateOrCreate(['sku' => $sku], [
                'item_name' => $name,
                'location' => $location,
                'quantity_in_stock' => $quantity,
                'unit_price' => $price,
            ]);
        }

        $capitalRecords = [
            ['Adaeze Okafor', 'Ordinary', 25000, 12500000, true],
            ['Chinedu Bello', 'Ordinary', 18000, 9000000, true],
            ['Mariam Adeyemi', 'Preference', 12000, 7500000, true],
            ['Internal Reserve', 'Preference', 8000, 5000000, false],
        ];

        foreach ($capitalRecords as [$name, $shareClass, $shares, $investment, $isPublic]) {
            CapitalRecord::updateOrCreate(
                ['shareholder_name' => $name, 'share_class' => $shareClass],
                [
                    'allocated_shares' => $shares,
                    'total_investment' => $investment,
                    'is_public' => $isPublic,
                ],
            );
        }
    }
}
