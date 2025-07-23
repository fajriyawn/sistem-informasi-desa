<?php

namespace App\Filament\Resources\DownloadLogResource\Pages;

use App\Filament\Resources\DownloadLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDownloadLogs extends ListRecords
{
    protected static string $resource = DownloadLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
