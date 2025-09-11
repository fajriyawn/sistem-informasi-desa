<?php

namespace App\Filament\Resources\SocSectionResource\Pages;

use App\Filament\Resources\SocSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocSections extends ListRecords
{
    protected static string $resource = SocSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
