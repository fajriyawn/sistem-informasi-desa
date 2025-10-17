<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Service;
use App\Models\Proposal;
use App\Models\TrainingRegistration;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\ProposalResource;
use App\Filament\Resources\TrainingRegistrationResource;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Laporan', Service::count())
                ->description('Jumlah laporan yang masuk')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('warning')
                ->url(ServiceResource::getUrl('index')),
            
            Stat::make('Total Proposal', Proposal::count())
                ->description('Jumlah proposal yang masuk')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->url(ProposalResource::getUrl('index')),
            
            Stat::make('Total Pendaftar Pelatihan', TrainingRegistration::count())
                ->description('Jumlah pendaftar pelatihan yang masuk')
                ->icon('heroicon-o-users')
                ->color('success')
                ->url(TrainingRegistrationResource::getUrl('index')),
        ];
    }
}
