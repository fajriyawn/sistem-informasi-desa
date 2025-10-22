<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingRegistrationResource\Pages;
use App\Filament\Resources\TrainingRegistrationResource\RelationManagers;
use App\Models\TrainingRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use App\Mail\StatusUpdateMail;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingRegistrationResource extends Resource
{
    protected static ?string $model = TrainingRegistration::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Pendaftar Pelatihan';
    protected static ?string $slug = 'pendaftar-pelatihan';
    protected static ?string $navigationGroup = 'Layanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('organization_name')->label('Instansi')->disabled(),
                Forms\Components\TextInput::make('name')->label('Penanggung Jawab')->disabled(),
                Forms\Components\TextInput::make('email')->label('Email')->disabled(),
                Forms\Components\TextInput::make('phone')->label('Telepon')->disabled(),
                Forms\Components\TextInput::make('training_topic')->label('Topik Pelatihan')->disabled(),
                Forms\Components\TextInput::make('participant_count')->label('Jumlah Peserta')->disabled(),
                Forms\Components\Textarea::make('notes')->label('Catatan')->columnSpanFull()->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Menunggu Konfirmasi' => 'Menunggu Konfirmasi',
                        'Telah Dihubungi' => 'Telah Dihubungi',
                        'Jadwal Disetujui' => 'Jadwal Disetujui',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organization_name')->label('Instansi')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Penanggung Jawab')->searchable(),
                Tables\Columns\TextColumn::make('training_topic')->label('Topik Pelatihan'),
                Tables\Columns\TextColumn::make('participant_count')->label('Jumlah Peserta'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu Konfirmasi' => 'warning',
                        'Telah Dihubungi' => 'primary',
                        'Jadwal Disetujui' => 'success',
                        'Selesai' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Daftar')->dateTime()->sortable(),
            ])

            ->actions([
                ActionGroup::make([
                    Action::make('updateStatus')
                        ->label('Update Status & Notifikasi')
                        ->icon('heroicon-o-paper-airplane')
                        ->form([
                            Select::make('status')
                                ->label('Status Baru')
                                ->options([
                                    'Telah Dihubungi' => 'Telah Dihubungi',
                                    'Jadwal Disetujui' => 'Jadwal Disetujui',
                                    'Selesai' => 'Selesai',
                                ])
                                ->required(),
                            Textarea::make('note')
                                ->label('Catatan untuk Pengguna')
                                ->rows(3),
                        ])
                        ->action(function (TrainingRegistration $record, array $data) {
                            // Update status record
                            $record->status = $data['status'];
                            $record->save();

                            // Kirim email notifikasi
                            Mail::to($record->email)->send(new StatusUpdateMail(
                                $record->name,
                                $data['status'],
                                $data['note'] ?? '',
                                'Pendaftaran Pelatihan'
                            ));

                            // Tampilkan notifikasi sukses
                            Notification::make()
                                ->success()
                                ->title('Status berhasil diperbarui dan notifikasi telah dikirim.')
                                ->send();
                        }),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
            ])
            ->defaultSort('created_at', 'desc');
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingRegistrations::route('/'),
            'create' => Pages\CreateTrainingRegistration::route('/create'),
            'edit' => Pages\EditTrainingRegistration::route('/{record}/edit'),
        ];
    }
}
