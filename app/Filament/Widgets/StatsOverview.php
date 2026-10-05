<?php

namespace App\Filament\Widgets;

use App\Models\CapitalRecord;
use App\Models\InventoryItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $inventoryValue = InventoryItem::query()
            ->sum(DB::raw('quantity_in_stock * unit_price'));

        return [
            Stat::make('Total Inventory Items', InventoryItem::count())
                ->description('Products across all locations')
                ->icon('heroicon-o-cube'),
            Stat::make('Total Inventory Value', "\u{20A6}".number_format((float) $inventoryValue, 2))
                ->description('Value of current stock')
                ->icon('heroicon-o-banknotes'),
            Stat::make('Total Investors / Shareholders', CapitalRecord::count())
                ->description('All capital records')
                ->icon('heroicon-o-user-group'),
            Stat::make('Total Capital Raised / Contributions', "\u{20A6}".number_format((float) CapitalRecord::sum('total_investment'), 2))
                ->description('Total recorded contributions')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}