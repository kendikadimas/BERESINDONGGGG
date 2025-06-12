<?php

namespace App\Filament\Tukang\Resources;

use App\Models\EmergencyRequest;
use App\Models\User;
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

    // Kustomisasi tampilan di sidebar
    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Pekerjaan Darurat';
    protected static ?int $navigationSort = 2; // Urutan di sidebar

    // Method ini adalah kunci untuk menampilkan pekerjaan yang relevan
    public static function getEloquentQuery(): Builder
    {
        // Hanya tampilkan permintaan dengan status 'pending' (belum ada yang ambil)
        return parent::getEloquentQuery()->where('status', 'pending');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi Masalah')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->description),
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Foto Bukti')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Masuk Pada')
                    ->dateTime('d M Y, H:i')
                    ->since(),
            ])
            ->actions([
                // INI ADALAH IMPLEMENTASI TOMBOL AKSI DARI LANGKAH 3
                Action::make('accept_emergency')
                    ->label('Terima Pekerjaan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation() // Meminta konfirmasi
                    ->modalHeading('Terima Pekerjaan Darurat?')
                    ->modalDescription('Apakah Anda yakin ingin mengambil pekerjaan ini? Pekerjaan akan hilang dari daftar tukang lain.')
                    ->action(function (EmergencyRequest $record) {
                        // Cek lagi untuk mencegah 2 tukang mengambil di waktu yang sama
                        if ($record->fresh()->status !== 'pending') {
                            Notification::make()
                                ->title('Pekerjaan ini sudah diambil tukang lain.')
                                ->warning()
                                ->send();
                            return;
                        }
                        
                        // Update status dan tugaskan ke tukang yang login saat ini
                        $record->update([
                            'status' => 'accepted', // atau 'in_progress' jika langsung dikerjakan
                            'tukang_id' => auth()->id(),
                        ]);

                        Notification::make()
                            ->title('Anda berhasil mengambil pekerjaan darurat!')
                            ->body('Segera hubungi customer dan menuju lokasi.')
                            ->success()
                            ->send();
                        
                        // Anda bisa menambahkan logika notifikasi ke customer di sini
                        // Notification::send($record->customer, new YourNotificationClass());
                    })
            ]);
    }
    
    // Karena resource ini 'simple' dan read-only untuk tukang, kita tidak perlu halaman lain
    
}