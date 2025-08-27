<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $countProducts = Product::count();
        $countCategoties = Category::count();
        $countOrders = Order::count();


        return [
            Stat::make('Products', $countProducts),
            Stat::make('Categories', $countCategoties),
            Stat::make('Orders', $countOrders),
        ];
    }
}
