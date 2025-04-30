<?php

namespace App\Filament\Resources\ProductCtegoryResource\Pages;

use App\Filament\Resources\ProductCtegoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductCtegory extends ViewRecord
{
    protected static string $resource = ProductCtegoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
