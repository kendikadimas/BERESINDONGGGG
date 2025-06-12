<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

// Impor yang dibutuhkan untuk Infolist
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\BadgeEntry; // <-- INI YANG SEBELUMNYA SALAH KETIK
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Customer'),
                Forms\Components\Select::make('tukang_id')
                    ->relationship('worker', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Tukang'),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('schedule')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Lokasi Pengerjaan')
                    ->required(),
                Forms\Components\Textarea::make('problem_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    // Perbaikan untuk sortable pada relasi
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            ->join('users as customers', 'orders.user_id', '=', 'customers.id')
                            ->orderBy('customers.name', $direction)
                            ->select('orders.*');
                    }),
                Tables\Columns\TextColumn::make('worker.name')
                    ->label('Pekerja')
                    ->searchable()
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            ->join('users as workers', 'orders.tukang_id', '=', 'workers.id')
                            ->orderBy('workers.name', $direction)
                            ->select('orders.*');
                    }),
                Tables\Columns\TextColumn::make('schedule')->label('Jadwal')->dateTime('d M Y, H:i')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Lokasi')->limit(30)->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'ongoing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\ViewAction::make()->icon('heroicon-o-information-circle')->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
       return $infolist
            ->schema([
                // Bagian untuk menampilkan detail pesanan
                Section::make('Detail Pesanan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('customer.name')->label('Customer'),
                        TextEntry::make('worker.name')->label('Tukang'),
                        TextEntry::make('service.name')->label('Service'),
                        TextEntry::make('schedule')->label('Schedule')->dateTime(),
                        TextEntry::make('location')->label('Lokasi'),
                        TextEntry::make('total_price')->label('Total price')->money('IDR'),
                        TextEntry::make('problem_description')
                            ->label('Problem description')
                            ->columnSpanFull(),
                        TextEntry::make('status')
                            ->label('Status Pekerjaan')
                            ->colors([
                                'warning' => 'pending',
                                'primary' => 'ongoing',
                                'success' => 'completed',
                                'danger' => 'cancelled',
                            ]),
                        TextEntry::make('payment_status')
                            ->label('Status Pembayaran')
                            ->colors([
                                'warning' => 'unpaid',
                                'paid' => 'success',
                                'failed' => 'danger',
                            ]),
                    ]),

                // --- INI BAGIAN PENTING UNTUK MENAMBAHKAN TOMBOL ---
               Actions::make([
                    // Ini adalah implementasi "Langkah 6: Tombol Bayar"
                    Action::make('pay')
                        ->label('Bayar Sekarang (Test via Admin)')
                        ->color('success')
                        ->icon('heroicon-o-credit-card')
                        
                        // Tombol ini hanya akan muncul jika kondisi terpenuhi
                        ->visible(fn ($record) => $record->payment_status === 'unpaid' && $record->status !== 'cancelled')
                        
                        // Aksi ini akan memicu "Langkah 7: Trigger Popup"
                        ->url(fn ($record) => route('checkout.show', $record), shouldOpenInNewTab: true),
                ])->fullWidth(), // Membuat container aksi selebar modal
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            // 'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }    
}