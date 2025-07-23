<?php

namespace App\Filament\Resources\SocReportResource\Pages;

use App\Filament\Resources\SocReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocReports extends ListRecords
{
    protected static string $resource = SocReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
