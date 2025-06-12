<?php

namespace App\Filament\Tukang\Widgets;

use App\Models\WarrantyClaim;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WarrantyJobStarted; // Anda perlu membuat notifikasi ini nanti

class ApprovedWarrantyClaims extends BaseWidget
{
    protected static ?string $heading = 'Ajuan Garansi (Disetujui)';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            // 1. Query untuk mengambil data
            ->query(function () {
                // Ambil klaim garansi dengan status 'approved' ATAU 'in_progress'
                // di mana tukang pada order terkait adalah user yang sedang login
                return WarrantyClaim::whereIn('status', ['approved', 'in_progress'])
                    ->whereHas('order', function ($query) {
                        $query->where('tukang_id', auth()->id());
                    });
            })
            // 2. Definisi Kolom Tabel
            ->columns([
                Tables\Columns\TextColumn::make('order.customer.name')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('order.service.name')
                    ->label('Layanan'),
                Tables\Columns\TextColumn::make('issue_description')
                    ->label('Detail Masalah')
                    ->limit(30),
                Tables\Columns\TextColumn::make('order.customer.address')
                    ->label('Lokasi')
                    ->limit(20),
                Tables\Columns\TextColumn::make('order.schedule')
                    ->label('Jadwal Asal')
                    ->dateTime('d M Y'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'approved',
                        'warning' => 'in_progress',
                    ]),
            ])
            // 3. Definisi Tombol Aksi
            ->actions([
                Action::make('start_work')
                    ->label('Kerjakan')
                    ->icon('heroicon-o-play-circle')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (WarrantyClaim $record) {
                        $record->update(['status' => 'in_progress']);
                        // Kirim notifikasi ke customer
                        // Notification::send($record->order->customer, new WarrantyJobStarted($record));
                        // Beri notifikasi sukses ke tukang
                        \Filament\Notifications\Notification::make()
                            ->title('Pekerjaan Garansi Dimulai')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (WarrantyClaim $record): bool => $record->status === 'approved'),

                Action::make('complete_work')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (WarrantyClaim $record) {
                        $record->update(['status' => 'completed']);
                        \Filament\Notifications\Notification::make()
                            ->title('Pekerjaan Garansi Selesai')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (WarrantyClaim $record): bool => $record->status === 'in_progress'),
            ]);
    }
}