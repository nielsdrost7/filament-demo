<?php

namespace App\Filament\Resources\Shop\OrderResource\Pages;

use App\Filament\Resources\Shop\OrderResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => \Filament\Schemas\Components\Tabs\Tab::make('All'),
            'new' => \Filament\Schemas\Components\Tabs\Tab::make()->query(fn ($query) => $query->where('status', 'new')),
            'processing' => \Filament\Schemas\Components\Tabs\Tab::make()->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => \Filament\Schemas\Components\Tabs\Tab::make()->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => \Filament\Schemas\Components\Tabs\Tab::make()->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => \Filament\Schemas\Components\Tabs\Tab::make()->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}
