<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
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

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationLabel = "Layanan Rehabilitasi";
    protected static ?string $pluralLabel = 'Layanan Rehabilitasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
                Forms\Components\TextInput::make('organization')->disabled(),
                Forms\Components\TextInput::make('location')->disabled(),
                Forms\Components\Textarea::make('description')->columnSpanFull()->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Menunggu Review' => 'Menunggu Review',
                        'Sedang Diproses' => 'Sedang Diproses',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('organization')->searchable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu Review' => 'warning',
                        'Sedang Diproses' => 'primary',
                        'Disetujui' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Pengajuan')->dateTime()->sortable(),
            ])
            ->filters([
                //
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
                                    'Sedang Diproses' => 'Sedang Diproses',
                                    'Disetujui' => 'Disetujui',
                                    'Ditolak' => 'Ditolak',
                                ])
                                ->required(),
                            Textarea::make('note')
                                ->label('Catatan untuk Pengguna')
                                ->rows(3),
                        ])
                        ->action(function (Proposal $record, array $data) {
                            // Update status record
                            $record->status = $data['status'];
                            $record->save();
                            
                            // Kirim email notifikasi
                            Mail::to($record->email)->send(new StatusUpdateMail(
                                $record->name,
                                $data['status'],
                                $data['note'] ?? '',
                                'Proposal Rehabilitasi'
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
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    // Ini adalah method baru Anda yang sudah ditempatkan dengan benar
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pengaju')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('phone')->label('Telepon'),
                        TextEntry::make('organization')->label('Organisasi'),
                    ]),
                Section::make('Detail Pengajuan')
                    ->schema([
                        TextEntry::make('location')->label('Lokasi'),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                        ViewEntry::make('file_path')
                            ->view('filament.infolists.components.file-preview')
                            ->label(''),
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
            'index' => Pages\ListProposals::route('/'),
            'view' => Pages\ViewProposal::route('/{record}'),
            'edit' => Pages\EditProposal::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
