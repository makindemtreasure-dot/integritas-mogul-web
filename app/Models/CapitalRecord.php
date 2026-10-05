<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalRecord extends Model
{
    /** @use HasFactory<\Database\Factories\CapitalRecordFactory> */
    use HasFactory;

    protected $fillable = [
        'shareholder_name',
        'share_class',
        'allocated_shares',
        'total_investment',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'allocated_shares' => 'integer',
            'total_investment' => 'decimal:2',
            'is_public' => 'boolean',
        ];
    }
}
