<?php

namespace App\Filament\Resources\GeographicFeatureResource\Pages;

use App\Filament\Resources\GeographicFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeographicFeatures extends ListRecords
{
    protected static string $resource = GeographicFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
