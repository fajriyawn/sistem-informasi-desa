<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocSectionResource\Pages;
use App\Filament\Resources\SocSectionResource\RelationManagers;
use App\Models\SocSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocSectionResource extends Resource
{
    protected static ?string $model = SocSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?string $pluralLabel = 'Konten SOC';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabledOn('edit'),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('soc_sections'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Gambar Preview'),
                TextColumn::make('title')
                    ->label('Judul Section')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Key Unik')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function canCreate(): bool
    {
        return false;
    }


    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocSections::route('/'),
            'create' => Pages\CreateSocSection::route('/create'),
            'edit' => Pages\EditSocSection::route('/{record}/edit'),
        ];
    }
}
