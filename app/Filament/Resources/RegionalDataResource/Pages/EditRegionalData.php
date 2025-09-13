<?php

namespace App\Filament\Resources\RegionalDataResource\Pages;

use App\Filament\Resources\RegionalDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegionalData extends EditRecord
{
    protected static string $resource = RegionalDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
