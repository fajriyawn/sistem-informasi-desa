<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\ServiceResource\Pages;
use Dom\Text;
use FormsComponents\Filament\Forms\Components\MapPicker;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationLabel = "Pelaporan";
    protected static ?string $pluralLabel = 'Pelaporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Grup field utama kita letakkan dalam Grid agar rapi
                Grid::make(2)->schema([
                    // Kolom Kiri: Informasi Laporan
                    Section::make('Detail Laporan')
                        ->schema([
                            TextInput::make('name')->label('Nama Lengkap')->required(),
                            TextInput::make('phone')->label('Nomor Telepon')->tel()->required(),
                            TextInput::make('email')->label('Email')->email()->required(),
                            TextInput::make('title')->label('Judul Laporan')->required(),
                            RichEditor::make('content')->label('Isi Laporan')->required()->columnSpanFull(),
                        ]),

                    // Kolom Kanan: Atribut dan Status
                    Section::make('Atribut & Status')
                        ->schema([
                            Select::make('type')->label('Type')->options(['laporan' => 'Laporan','kontribusi' => 'Kontribusi','lainnya' => 'Lainnya',])->required(),
                            TextInput::make('location_name')->label('Nama Daerah Laporan (Opsional)'),
                            TextInput::make('latitude'),
                            TextInput::make('longitude'),

                            // --- BAGIAN UNTUK MENGUBAH STATUS ---
                            Select::make('status')
                                ->options([
                                    'Baru Masuk' => 'Baru Masuk',
                                    'Sedang Diproses' => 'Sedang Diproses',
                                    'Terselesaikan' => 'Terselesaikan',
                                    'Ditolak' => 'Ditolak',
                                    'Butuh Info Tambahan' => 'Butuh Info Tambahan',
                                ])
                                ->required(),
                            Textarea::make('internal_notes')
                                ->label('Catatan Internal (Untuk Admin)')
                                ->rows(4),
                        ]),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul Laporan')->searchable()->limit(30),
                TextColumn::make('name')->label('Pelapor')->searchable(),
                // --- KOLOM BADGE STATUS ---
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'Baru Masuk' => 'primary',
                        'Sedang Diproses' => 'warning',
                        'Terselesaikan' => 'success',
                        'Ditolak' => 'danger',
                        'Butuh Info Tambahan' => 'secondary',
                    })-> searchable(),
                TextColumn::make('created_at')->label('Tanggal Lapor')->date('d M Y')->sortable(),
                TextColumn::make('tracking_code')
                    ->label('Kode Tracking')->searchable(),


            ])
            ->filters([
                // --- FILTER BERDASARKAN STATUS ---
                SelectFilter::make('status')
                    ->options([
                        'Baru Masuk' => 'Baru Masuk',
                        'Sedang Diproses' => 'Sedang Diproses',
                        'Terselesaikan' => 'Terselesaikan',
                        'Ditolak' => 'Ditolak',
                        'Butuh Info Tambahan' => 'Butuh Info Tambahan',
                    ])
            ])
            // ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // ... sisa file (getRelations, getPages) biarkan seperti semula ...
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
