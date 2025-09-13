<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IcmPlanResource\Pages;
use App\Filament\Resources\IcmPlanResource\RelationManagers;
use App\Models\IcmPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IcmPlanResource extends Resource
{
    protected static ?string $model = IcmPlan::class;
    protected static ?string $label = 'Daftar ICM Plan';
    protected static ?string $pluralLabel = 'Daftar ICM Plan';
    protected static ?string $navigationGroup = 'ICM Plan & SOC';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('city_id')->relationship('city', 'name')->required(),
            Forms\Components\Select::make('tahun')
                ->options(array_combine(range(date('Y') + 5, 2020), range(date('Y') + 5, 2020)))
                ->required(),

            // Grouping screenshot agar lebih rapi
            Forms\Components\Group::make()->schema([
                Forms\Components\FileUpload::make('ss_lingkungan')->label('Screenshot Lingkungan')->disk('public')->directory('icm-screenshots')->image(),
                Forms\Components\FileUpload::make('ss_tata_kelola')->label('Screenshot Tata Kelola')->disk('public')->directory('icm-screenshots')->image(),
                Forms\Components\FileUpload::make('ss_pembangunan')->label('Screenshot Pembangunan')->disk('public')->directory('icm-screenshots')->image(),
                Forms\Components\FileUpload::make('ss_matriks_icm')->label('Screenshot Matriks ICM')->disk('public')->directory('icm-screenshots')->image(),
            ])->columns(2), // Menampilkan screenshot dalam 2 kolom

            // Field untuk dokumen utama dengan logika penyimpanan nama file asli
            Forms\Components\FileUpload::make('file_laporan')
                ->label('Dokumen Rencana Utama (PDF)')
                ->disk('public')
                ->directory('icm-plans')
                ->required()
                ->acceptedFileTypes(['application/pdf'])
                ->saveUploadedFileUsing(function ($file) {
                    // Simpan file dengan nama unik, tapi tetap catat nama aslinya
                    $originalName = $file->getClientOriginalName();
                    return $file->storeAs('icm-plans', uniqid() . '_' . $originalName, 'public');
                })
                ->afterStateUpdated(function ($state, callable $set) {
                    // Setelah file diupload, simpan nama aslinya ke field 'original_filename'
                    if ($state) {
                        $set('original_filename', $state->getClientOriginalName());
                    }
                }),

            // Field hidden ini harus menjadi elemen terpisah, bukan di dalam FileUpload
            Forms\Components\Hidden::make('original_filename'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('city.name')->label('Kota/Kabupaten')->sortable(),
            Tables\Columns\TextColumn::make('tahun')->sortable(),
            // Kolom 'title' dihapus, diganti dengan nama file laporan
            Tables\Columns\TextColumn::make('original_filename')->label('Nama File Laporan')->searchable(),
        ])->defaultSort('tahun', 'desc');
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
            'index' => Pages\ListIcmPlans::route('/'),
            'create' => Pages\CreateIcmPlan::route('/create'),
            'edit' => Pages\EditIcmPlan::route('/{record}/edit'),
        ];
    }
}
