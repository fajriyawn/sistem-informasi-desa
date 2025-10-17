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
use Filament\Forms\Components\FileUpload;
use Dom\Text;
use FormsComponents\Filament\Forms\Components\MapPicker;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationLabel = "Pelaporan";
    protected static ?string $pluralLabel = 'Pelaporan';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Diri Pelapor')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')->label('Nama Lengkap'),
                            TextInput::make('phone')->label('Nomor Telepon'),
                        ]),
                        TextInput::make('email')->label('Email')->columnSpanFull(),
                    ]),
                Section::make('Detail Laporan')
                    ->schema([
                        TextInput::make('title')->label('Judul Laporan'),
                        Grid::make(2)->schema([
                            Select::make('type')
                                ->label('Tipe Laporan')
                                ->options([
                                    'Infrastruktur' => 'Infrastruktur',
                                    'Lingkungan' => 'Lingkungan',
                                    'Pelayanan Publik' => 'Pelayanan Publik',
                                    'Lainnya' => 'Lainnya',
                                ]),
                            Select::make('city_name')
                                ->label('Kabupaten/Kota Lokasi')
                                ->options([
                                    'Batang' => 'Batang',
                                    'Jepara' => 'Jepara',
                                    'Kendal' => 'Kendal',
                                    'Demak' => 'Demak',
                                    'Semarang' => 'Semarang',
                                ]),
                        ]),
                        TextInput::make('address_detail')->label('Detail Alamat Kejadian'),
                        Textarea::make('content')->label('Isi Laporan'),
                        FileUpload::make('attachment')->label('Lampiran'),
                        Select::make('status')
                                ->label('Status Laporan')
                                ->options([
                                    'Baru Masuk' => 'Baru Masuk',
                                    'Sedang Diproses' => 'Sedang Diproses',
                                    'Terselesaikan' => 'Terselesaikan',
                                    'Ditolak' => 'Ditolak',
                                ]),
                    ]),
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
                        'Diterima' => 'success',
                        default => 'secondary',
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
            // 'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
