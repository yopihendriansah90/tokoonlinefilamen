<?php

namespace App\Filament\Resources\Products\Pages;

use App\Models\Product;
use Illuminate\Support\Str;
use Filament\Actions\CreateAction;
use Filament\Schemas\Components\Tabs;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Products\ProductResource;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Create Product')
            ->icon('heroicon-o-plus')
            ->tooltip('Create a new product'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
            ->badge(Product::count())
            ->badgeTooltip(fn (Tab $tab) =>$tab->getBadge() . ' ' . Str::plural('product', $tab->getBadge()) . ' in total'),

            'Active' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
                ->badge(Product::where('is_active', true)->count())
                ->badgeTooltip(fn (Tab $tab) => $tab->getBadge() . ' ' . Str::plural('product', $tab->getBadge()) . ' active'),
                
            'Inactive' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false))
                ->badge(Product::where('is_active', false)->count())
                ->badgeTooltip(fn (Tab $tab) => $tab->getBadge() . ' ' . Str::plural('product', $tab->getBadge()) . ' inactive'),
        ];
    }

    public function getDefaultActiveTab(): string
    {
        return 'Active';
    }
}
