<?php

namespace App\Http\Controllers;

use App\Models\CapitalRecord;
use App\Models\InventoryItem;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $items = InventoryItem::query()
            ->where('status', '!=', 'out_of_stock')
            ->orderBy('item_name')
            ->paginate(12);

        return view('welcome', compact('items'));
    }

    public function about(): View
    {
        return view('about');
    }

    public function produce(): View
    {
        $items = InventoryItem::query()
            ->where('status', '!=', 'out_of_stock')
            ->orderBy('location')
            ->orderBy('item_name')
            ->get()
            ->groupBy('location');

        return view('produce', compact('items'));
    }

    public function investors(): View
    {
        $records = CapitalRecord::query()
            ->where('is_public', true)
            ->orderBy('shareholder_name')
            ->get();

        return view('investors', [
            'records' => $records,
            'totalInvestment' => $records->sum('total_investment'),
            'totalShares' => $records->sum('allocated_shares'),
        ]);
    }
}