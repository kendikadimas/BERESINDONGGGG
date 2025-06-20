<?php
// app/Filament/Tukang/Resources/EmergencyRequestResource.php

namespace App\Filament\Tukang\Resources;

use App\Filament\Tukang\Resources\EmergencyRequestResource\Pages;
use App\Models\EmergencyRequest;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class EmergencyRequestResource extends Resource
{
    protected static ?string $model = EmergencyRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Pekerjaan Darurat';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'pending');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label('Customer')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Deskripsi Masalah')->limit(50),
                Tables\Columns\ImageColumn::make('photo_path')->label('Foto Bukti')->disk('public'),
                Tables\Columns\TextColumn::make('created_at')->label('Masuk Pada')->since(),
            ])
            ->actions([
                Action::make('accept_emergency')
                    ->label('Terima Pekerjaan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (EmergencyRequest $record) {
                        if ($record->fresh()->status !== 'pending') {
                            Notification::make()->title('Pekerjaan ini sudah diambil.')->warning()->send();
                            return;
                        }
                        $record->update(['status' => 'accepted', 'tukang_id' => auth()->id()]);
                        Notification::make()->title('Anda berhasil mengambil pekerjaan!')->success()->send();
                    })
            ]);
    }

    // Method getPages() ini sekarang valid karena merujuk ke file yang ada
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmergencyRequests::route('/'),
            // 'create' => Pages\CreateEmergencyRequest::route('/create'), // Hapus jika tukang tidak bisa membuat
        ];
    }
}