<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\IcmPlan;
use Filament\Forms\Form;
use App\Models\SocReport;
use Filament\Tables\Table;
use App\Models\DownloadLog;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DownloadLogResource\Pages;
use App\Filament\Resources\DownloadLogResource\RelationManagers;

class DownloadLogResource extends Resource
{
    protected static ?string $model = DownloadLog::class;

    protected static ?string $navigationGroup = 'ICM Plan & SOC';

    protected static ?string $label = 'Daftar Pengunduh';

    protected static ?string $pluralLabel = 'Daftar Pengunduh';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('soc_report_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom 1: Menampilkan Tipe Dokumen (SOC atau ICM Plan)
                Tables\Columns\TextColumn::make('downloadable_type')
                    ->label('Tipe Dokumen')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match (basename($state)) {
                        'SocReport' => 'SOC Report',
                        'IcmPlan' => 'ICM Plan',
                        default => 'Lainnya',
                    })
                    ->color(fn (string $state): string => match (basename($state)) {
                        'SocReport' => 'success',
                        'IcmPlan' => 'primary',
                        default => 'gray',
                    }),

                // Kolom 2: Menampilkan Detail Laporan (Kota dan Tahun)
                Tables\Columns\TextColumn::make('downloadable.id') // Gunakan kolom acak sebagai basis
                    ->label('Detail Laporan')
                    ->formatStateUsing(function ($record) {
                        if (!$record->downloadable) {
                            return 'Data tidak ditemukan';
                        }
                        // Karena SocReport & IcmPlan punya relasi 'city' dan kolom 'tahun'
                        return $record->downloadable->city->name . ' (' . $record->downloadable->tahun . ')';
                    })
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->whereHasMorph(
                                'downloadable',
                                [SocReport::class, IcmPlan::class],
                                fn (Builder $q) => $q->whereHas('city', fn ($cityQuery) => $cityQuery->where('name', 'like', "%{$search}%"))
                                                      ->orWhere('tahun', 'like', "%{$search}%")
                            );
                        }
                    ),

                // Kolom 3 & 4: Data Pengunduh
                Tables\Columns\TextColumn::make('name')->label('Nama Pengunduh')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),

                // Kolom 5: Waktu
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Download')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDownloadLogs::route('/'),
            'create' => Pages\CreateDownloadLog::route('/create'),
            'edit' => Pages\EditDownloadLog::route('/{record}/edit'),
        ];
    }
}
