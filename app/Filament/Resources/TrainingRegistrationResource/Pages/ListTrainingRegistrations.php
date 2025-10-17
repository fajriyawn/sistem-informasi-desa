<?php

namespace App\Filament\Resources\TrainingRegistrationResource\Pages;

use App\Filament\Resources\TrainingRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListTrainingRegistrations extends ListRecords
{
    protected static string $resource = TrainingRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make()
                ->label('Semua Pendaftar Pelatihan')
                ->badge(\App\Models\TrainingRegistration::count()),
            
            'menunggu_konfirmasi' => Tab::make()
                ->label('Menunggu Konfirmasi')
                ->badge(\App\Models\TrainingRegistration::where('status', 'Menunggu Konfirmasi')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Menunggu Konfirmasi')),
            
            'telah_dihubungi' => Tab::make()
                ->label('Telah Dihubungi')
                ->badge(\App\Models\TrainingRegistration::where('status', 'Telah Dihubungi')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Telah Dihubungi')),
            
            'jadwal_disetujui' => Tab::make()
                ->label('Jadwal Disetujui')
                ->badge(\App\Models\TrainingRegistration::where('status', 'Jadwal Disetujui')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Jadwal Disetujui')),
            
            'selesai' => Tab::make()
                ->label('Selesai')
                ->badge(\App\Models\TrainingRegistration::where('status', 'Selesai')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Selesai')),
        ];
    }
}
