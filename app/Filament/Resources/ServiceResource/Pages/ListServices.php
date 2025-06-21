<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
// --- PASTIKAN USE STATEMENT INI ADA ---
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * Mendefinisikan Tabs untuk filtering cepat di halaman daftar.
     */
    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua Laporan')
                ->badge(static::getModel()::count()),

            'baru' => Tab::make('Baru Masuk')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Baru Masuk'))
                ->badge(static::getModel()::where('status', 'Baru Masuk')->count()),

            'diproses' => Tab::make('Sedang Diproses')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Sedang Diproses'))
                ->badge(static::getModel()::where('status', 'Sedang Diproses')->count()),
                
            'selesai' => Tab::make('Terselesaikan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Terselesaikan'))
                ->badge(static::getModel()::where('status', 'Terselesaikan')->count()),

            'ditolak' => Tab::make('Ditolak')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Ditolak'))
                ->badge(static::getModel()::where('status', 'Ditolak')->count()),
        ];
    }
}