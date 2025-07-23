<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Filament\Resources\GalleryItemResource\RelationManagers;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?string $label = 'Post Galeri';

    protected static ?string $pluralLabel = 'Post Galeri';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\RichEditor::make('caption')->columnSpanFull(),
                Forms\Components\Select::make('type')
                    ->options(['image' => 'Image', 'video' => 'Video'])
                    ->required()->reactive(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Image File')
                    ->disk('public')->directory('gallery')
                    ->image() // Hanya untuk gambar
                    ->visible(fn ($get) => $get('type') === 'image'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Video File')
                    ->disk('public')->directory('gallery')
                    ->acceptedFileTypes(['video/mp4', 'video/webm']) // Hanya untuk video
                    ->visible(fn ($get) => $get('type') === 'video'),
                Forms\Components\DateTimePicker::make('published_at')->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
    return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')->disk('public')->label('Preview'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
