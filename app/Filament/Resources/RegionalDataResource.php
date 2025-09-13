<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionalDataResource\Pages;
use App\Models\RegionalData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegionalDataResource extends Resource
{
    protected static ?string $model = RegionalData::class;
    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationLabel = 'Data Regional';
    protected static ?string $slug = 'data-regional';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kota/Kabupaten'),

                Forms\Components\TextInput::make('indicator_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Indikator')
                    ->placeholder('Contoh: Luas Hutan Mangrove (ha)'),

                Forms\Components\TextInput::make('indicator_value')
                    ->required()
                    ->maxLength(255)
                    ->label('Nilai Indikator')
                    ->placeholder('Contoh: 1,250.75'),

                Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->required()
                    ->label('Tahun Data')
                    ->placeholder('Contoh: 2024'),

                Forms\Components\TextInput::make('source')
                    ->maxLength(255)
                    ->label('Sumber Data')
                    ->placeholder('Contoh: Dinas Kelautan & Perikanan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Kota/Kabupaten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('indicator_name')
                    ->label('Indikator')
                    ->searchable(),
                Tables\Columns\TextColumn::make('indicator_value')
                    ->label('Nilai'),
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city')
                    ->relationship('city', 'name')
                    ->label('Filter Berdasarkan Kota'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegionalData::route('/'),
            'create' => Pages\CreateRegionalData::route('/create'),
            'edit' => Pages\EditRegionalData::route('/{record}/edit'),
        ];
    }
}
