<?php

namespace App\Filament\Resources\ProductCtegoryResource\Pages;

use App\Filament\Resources\ProductCtegoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCtegories extends ListRecords
{
    protected static string $resource = ProductCtegoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
