<?php

namespace App\Filament\Resources\SocSectionResource\Pages;

use App\Filament\Resources\SocSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocSection extends EditRecord
{
    protected static string $resource = SocSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
