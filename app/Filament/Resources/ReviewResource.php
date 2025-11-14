<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\SocReport;
use App\Models\IcmPlan;
use App\Models\City;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'ICM Plan & SOC';

    protected static ?string $navigationLabel = 'Ulasan Publik';

    protected static ?int $navigationSort = 3;

    protected static ?string $label = 'Ulasan';

    protected static ?string $pluralLabel = 'Ulasan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Ulasan')
                            ->disabled()
                            ->rows(5),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->default('Anonym'),
                
                Tables\Columns\TextColumn::make('reviewable')
                    ->label('Dokumen Terkait')
                    ->formatStateUsing(function ($record) {
                        if ($record->reviewable instanceof SocReport) {
                            return 'Laporan SOC: ' . $record->reviewable->city->name . ' (' . $record->reviewable->tahun . ')';
                        } elseif ($record->reviewable instanceof IcmPlan) {
                            return 'Rencana ICM: ' . $record->reviewable->city->name . ' (' . $record->reviewable->tahun . ')';
                        }
                        return '-';
                    })
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                
                Tables\Columns\TextColumn::make('content')
                    ->label('Isi Ulasan')
                    ->limit(50),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Tampilkan')
                    ->onIcon('heroicon-o-eye')
                    ->offIcon('heroicon-o-eye-slash'),
                                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('reviewable_type')
                    ->label('Tipe Dokumen')
                    ->options([
                        'App\\Models\\SocReport' => 'Laporan SOC',
                        'App\\Models\\IcmPlan' => 'Rencana ICM',
                    ]),
                
                Tables\Filters\SelectFilter::make('city')
                    ->label('Daerah')
                    ->options(City::pluck('name', 'id')->toArray())
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $value): Builder => $query->whereHasMorph(
                                'reviewable',
                                [SocReport::class, IcmPlan::class],
                                fn (Builder $query) => $query->where('city_id', $value)
                            )
                        );
                    }),
                
                Tables\Filters\Filter::make('tahun')
                    ->label('Tahun')
                    ->form([
                        Forms\Components\TextInput::make('tahun')
                            ->label('Tahun')
                            ->placeholder('Contoh: 2024'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['tahun'],
                            fn (Builder $query, $value): Builder => $query->whereHasMorph(
                                'reviewable',
                                [SocReport::class, IcmPlan::class],
                                fn (Builder $query) => $query->where('tahun', $value)
                            )
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->headerActions([
                // Disable create action - no header actions
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListReviews::route('/'),
            'view' => Pages\ViewReview::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['reviewable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    
                    SocReport::class => ['city'], 
                    
                    // Asumsi IcmPlan juga punya relasi 'city'
                    // Jika tidak, ganti ['city'] menjadi []
                    IcmPlan::class => ['city'], 
                ]);
            }]);
    }
}