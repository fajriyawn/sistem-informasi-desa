<?php

namespace App\Filament\Resources\IcmPlanResource\Pages;

use App\Filament\Resources\IcmPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIcmPlans extends ListRecords
{
    protected static string $resource = IcmPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
