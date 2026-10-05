<?php

namespace App\Filament\Resources\CapitalRecordResource\Pages;

use App\Filament\Resources\CapitalRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCapitalRecord extends EditRecord
{
    protected static string $resource = CapitalRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
