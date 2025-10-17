<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Filament\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalResource::class;

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
                ->label('Semua Layanan Rehabilitasi')
                ->badge(\App\Models\Proposal::count()),
            
            'menunggu_review' => Tab::make()
                ->label('Menunggu Review')
                ->badge(\App\Models\Proposal::where('status', 'Menunggu Review')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Menunggu Review')),
            
            'sedang_diproses' => Tab::make()
                ->label('Sedang Diproses')
                ->badge(\App\Models\Proposal::where('status', 'Sedang Diproses')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Sedang Diproses')),
            
            'disetujui' => Tab::make()
                ->label('Disetujui')
                ->badge(\App\Models\Proposal::where('status', 'Disetujui')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Disetujui')),
            
            'ditolak' => Tab::make()
                ->label('Ditolak')
                ->badge(\App\Models\Proposal::where('status', 'Ditolak')->count())
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Ditolak')),
        ];
    }
}
