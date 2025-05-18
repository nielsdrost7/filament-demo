<?php

namespace App\Filament\Clusters\Products\Resources\BrandResource\RelationManagers;

use App\Filament\Clusters\Products\Resources\ProductResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return ProductResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return ProductResource::table($table)
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }
}
