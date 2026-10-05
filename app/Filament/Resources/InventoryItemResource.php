<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryItemResource\Pages;
use App\Models\InventoryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InventoryItemResource extends Resource
{
    protected static ?string $model = InventoryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sku')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('inventory')
                    ->visibility('public')
                    ->maxSize(5120),
                Forms\Components\Select::make('location')
                    ->options(['Akure' => 'Akure', 'Ifo' => 'Ifo'])
                    ->required(),
                Forms\Components\TextInput::make('quantity_in_stock')
                    ->integer()
                    ->minValue(0)
                    ->required()
                    ->default(0),
                Forms\Components\TextInput::make('unit_price')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('₦')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sku')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Akure' ? 'warning' : 'success'),
                Tables\Columns\TextColumn::make('quantity_in_stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->formatStateUsing(fn ($state): string => '₦'.number_format((float) $state, 2)),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'in_stock' => 'success',
                        'low_stock' => 'warning',
                        default => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('location')
                    ->options(['Akure' => 'Akure', 'Ifo' => 'Ifo']),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'in_stock' => 'In stock',
                        'low_stock' => 'Low stock',
                        'out_of_stock' => 'Out of stock',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventoryItems::route('/'),
            'create' => Pages\CreateInventoryItem::route('/create'),
            'edit' => Pages\EditInventoryItem::route('/{record}/edit'),
        ];
    }
}
