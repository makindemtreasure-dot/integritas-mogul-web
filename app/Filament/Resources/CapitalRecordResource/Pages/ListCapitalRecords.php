<?php

namespace App\Filament\Resources\CapitalRecordResource\Pages;

use App\Filament\Resources\CapitalRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCapitalRecords extends ListRecords
{
    protected static string $resource = CapitalRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
