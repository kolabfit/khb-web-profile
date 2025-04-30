<?php

namespace App\Filament\Resources\ProductCtegoryResource\Pages;

use App\Filament\Resources\ProductCtegoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCtegory extends EditRecord
{
    protected static string $resource = ProductCtegoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
