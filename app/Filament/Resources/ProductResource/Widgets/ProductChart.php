<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ProductCategory;

class ProductChart extends ChartWidget
{
    protected static ?string $heading = 'Produk per Kategori';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = ProductCategory::withCount('products')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $data->pluck('products_count'),
                    'backgroundColor' => '#6366f1',
                ],
            ],
            'labels' => $data->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti 'pie', 'line', dll.
    }
}
