<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarrantyClaimResource\Pages;
use App\Filament\Resources\WarrantyClaimResource\RelationManagers;
use App\Models\WarrantyClaim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class WarrantyClaimResource extends Resource
{
    protected static ?string $model = WarrantyClaim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // app/Filament/Resources/WarrantyClaimResource.php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('order_id')
                ->relationship('order', 'id') // Tampilkan berdasarkan ID order
                ->searchable()
                ->required(),
            Forms\Components\Textarea::make('issue_description')
                ->required()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('proof_photo_path')
                ->label('Foto Bukti Kerusakan')
                ->disk('public') // Menyimpan file ke storage/app/public
                ->directory('warranty-proofs') // di dalam subfolder
                ->image() // Hanya menerima file gambar
                ->imageEditor(), // Memberikan editor gambar sederhana
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->required(),
            Forms\Components\Textarea::make('admin_notes')
                ->columnSpanFull(),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->sortable(),
            // Mengambil nama Customer melalui relasi bertingkat: Claim -> Order -> Customer
            Tables\Columns\TextColumn::make('order.customer.name')
                ->label('Customer')
                ->searchable(),
            // Mengambil nama Pekerja melalui relasi bertingkat: Claim -> Order -> Worker
            Tables\Columns\TextColumn::make('order.worker.name')
                ->label('Pekerja')
                ->searchable(),
            Tables\Columns\TextColumn::make('order.customer.address')
                ->label('Lokasi')
                ->limit(20)
                ->tooltip(fn ($record) => $record->order->customer->address), // Tooltip untuk alamat lengkap
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'approved',
                    'danger' => 'rejected',
                ]),
        ])
        ->filters([
            //
        ])
        ->actions([
            // Tombol "Lihat" untuk membuka detail di modal
            Tables\Actions\ViewAction::make()->label('Lihat')->button(),
            
            // Aksi Kustom untuk Menolak (Reject)
            Tables\Actions\Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->iconButton()
                ->requiresConfirmation() // Meminta konfirmasi sebelum menolak
                ->form([
                    Forms\Components\Textarea::make('admin_notes')
                        ->label('Alasan Penolakan')
                        ->required(),
                ])
                ->action(function (WarrantyClaim $record, array $data) {
                    $record->status = 'rejected';
                    $record->admin_notes = $data['admin_notes'];
                    $record->save();
                    // Kirim notifikasi ke customer (opsional)
                })
                ->visible(fn (WarrantyClaim $record): bool => $record->status === 'pending'),

            // Aksi Kustom untuk Menyetujui (Approve)
            Tables\Actions\Action::make('approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->iconButton()
                ->requiresConfirmation()
                ->action(function (WarrantyClaim $record) {
                    $record->status = 'approved';
                    $record->save();
                    // Logika untuk "memanggil tukang" (misalnya, mengirim notifikasi)
                    // Notification::send($record->order->worker, new WarrantyJobNotification($record));
                })
                ->visible(fn (WarrantyClaim $record): bool => $record->status === 'pending'),
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
            'index' => Pages\ListWarrantyClaims::route('/'),
            'create' => Pages\CreateWarrantyClaim::route('/create'),
            'view' => Pages\ViewWarrantyClaim::route('/{record}'),
            'edit' => Pages\EditWarrantyClaim::route('/{record}/edit'),
        ];
    }


public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            TextEntry::make('order.customer.name')->label('Customer'),
            TextEntry::make('order.worker.name')->label('Pekerja'),
            TextEntry::make('issue_description')
                ->label('Deskripsi Kerusakan')
                ->columnSpanFull(), // Agar mengambil lebar penuh
            ImageEntry::make('proof_photo_path')
                ->label('Bukti Kerusakan')
                ->disk('public'), // Pastikan gambar disimpan di storage/app/public
        ]);
}
}
