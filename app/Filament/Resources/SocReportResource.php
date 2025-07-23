<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocReportResource\Pages;
use App\Filament\Resources\SocReportResource\RelationManagers;
use App\Models\SocReport;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class SocReportResource extends Resource
{
    protected static ?string $model = SocReport::class;

    protected static ?string $navigationGroup = 'SOC';

    protected static ?string $label = 'Daftar Laporan SOC';

    protected static ?string $pluralLabel = 'Daftar Laporan SOC';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kota/Kabupaten'),

                Select::make('tahun')
                    ->options(function () {
                        // Membuat pilihan tahun dari 2020 sampai 5 tahun ke depan
                        return array_combine(
                            range(date('Y') + 5, 2020),
                            range(date('Y') + 5, 2020)
                        );
                    })
                    ->required(),

                FileUpload::make('ss_lingkungan')
                    ->label('Status Lingkungan Pesisir')
                    ->image() // Agar ada preview gambar
                    ->disk('public') // Simpan di storage/app/public
                    ->directory('soc-screenshots') // Dalam folder 'soc-screenshots'
                    ->nullable(),

                FileUpload::make('ss_tata_kelola')
                    ->label('Diagram Radar Posisi antar Elemen Tata Kelola')
                    ->image()
                    ->disk('public')
                    ->directory('soc-screenshots')
                    ->nullable(),

                FileUpload::make('ss_pembangunan')
                    ->label('Diagram Radar Posisi Antar Elemen Pembangunan Berkelanjutan')
                    ->image()
                    ->disk('public')
                    ->directory('soc-screenshots')
                    ->nullable(),

                FileUpload::make('ss_matriks_icm')
                    ->label('Matriks Penilaian Capaian Indikator ICM')
                    ->image()
                    ->disk('public')
                    ->directory('soc-screenshots')
                    ->nullable(),

                FileUpload::make('file_laporan')
                    ->label('File Laporan Utama (PDF/DOCX)')
                    ->disk('public')
                    ->directory('soc-reports')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->nullable()
                    // Tambahkan blok ini untuk menyimpan nama file asli
                    ->saveUploadedFileUsing(function ($file, $get) {
                        $originalName = $file->getClientOriginalName();
                        // Simpan file dengan nama hash untuk keamanan, tapi kita akan catat nama aslinya
                        return $file->storeAs('soc-reports', uniqid() . '_' . $originalName, 'public');
                    })
                    ->mutateDehydratedStateUsing(function ($state, $get) {
                        // Ini memastikan path yang disimpan di DB benar
                        return $state;
                    })
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        if ($state) {
                            // Ambil nama file asli dan simpan ke field original_filename
                            $set('original_filename', $state->getClientOriginalName());
                        }
                    }),
                    Forms\Components\Hidden::make('original_filename'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('city.name')
                    ->label('Kota/Kabupaten')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSocReports::route('/'),
            'create' => Pages\CreateSocReport::route('/create'),
            'edit' => Pages\EditSocReport::route('/{record}/edit'),
        ];
    }
}
