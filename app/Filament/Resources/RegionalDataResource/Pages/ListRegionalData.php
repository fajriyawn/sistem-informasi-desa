<?php

namespace App\Filament\Resources\RegionalDataResource\Pages;

use App\Filament\Resources\RegionalDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegionalData extends ListRecords
{
    protected static string $resource = RegionalDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
