<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaLibraryResource\Pages;
use App\Models\MediaLibrary;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MediaLibraryResource extends Resource
{
    protected static ?string $model = MediaLibrary::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?string $label = 'Media';

    protected static ?string $pluralLabel = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('file_path')
                            ->label('File')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('media-library')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->previewable(true)
                            ->reactive()
                            ->maxSize(5120)
                            // ->getUploadedFileUrlUsing(function ($state) {
                            //     return is_string($state) ? Storage::disk('public')->url($state) : null;
                            // })s
                            ->afterStateUpdated(function ($state, $set, $livewire) {
                                if ($state) {
                                    $path = $state->getRealPath();
                                    
                                    // Gunakan $livewire->set() untuk mengisi field lain
                                    $livewire->set('data.file_name', pathinfo($path, PATHINFO_FILENAME));
                                    $livewire->set('data.mime_type', mime_content_type($path));
                                    $livewire->set('data.file_size', filesize($path));
                                }
                            }),

                        TextInput::make('file_name')
                            ->label('Nama File')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('caption')
                            ->label('Keterangan')
                            ->maxLength(255),

                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'image' => 'Gambar',
                                'document' => 'Dokumen',
                                'video' => 'Video',
                                'other' => 'Lainnya',
                            ])
                            ->default('image'),

                        Hidden::make('mime_type')->required(),
                        Hidden::make('file_size')->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('File')
                    ->url(fn ($record) => asset('storage/' . $record->file_path)),
                Tables\Columns\TextColumn::make('file_name')
                    ->label('Nama File')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe'),
                Tables\Columns\TextColumn::make('caption')
                    ->label('Keterangan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'image' => 'Gambar',
                        'document' => 'Dokumen',
                        'video' => 'Video',
                        'other' => 'Lainnya',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMediaLibraries::route('/'),
            'create' => Pages\CreateMediaLibrary::route('/create'),
            'edit' => Pages\EditMediaLibrary::route('/{record}/edit'),
        ];
    }
}