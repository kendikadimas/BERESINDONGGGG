<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // app/Filament/Resources/OrderResource.php

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Menggunakan Select dengan relasi untuk memilih customer
            Forms\Components\Select::make('user_id')
                ->relationship('customer', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Customer'),

            // Menggunakan Select dengan relasi untuk memilih tukang
            Forms\Components\Select::make('tukang_id')
                ->relationship('worker', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Tukang'),
            
            // Anda juga bisa melakukan hal yang sama untuk service_id
            Forms\Components\Select::make('service_id')
                ->relationship('service', 'name')
                ->required(),

            Forms\Components\DateTimePicker::make('schedule')
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
            // Menggunakan notasi titik untuk menampilkan nama dari relasi
            Tables\Columns\TextColumn::make('customer.name')
                ->label('Customer')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('worker.name')
                ->label('Pekerja')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('schedule')
                ->label('Jadwal')
                ->dateTime('d M Y, H:i') // Format tanggal agar mudah dibaca
                ->sortable(),
            // Lokasi kita ambil dari alamat customer
            Tables\Columns\TextColumn::make('customer.address')
                ->label('Lokasi')
                ->limit(25) // Batasi panjang teks agar tidak merusak tabel
                ->searchable(),
            // Gunakan BadgeColumn agar status lebih menarik
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'primary' => 'ongoing',
                    'success' => 'completed',
                    'danger' => 'cancelled',
                ]),
        ])
        ->filters([
            // Tambahkan filter berdasarkan status pesanan
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'ongoing' => 'Berlangsung',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ])
        ])
        ->actions([
            // Tombol Edit dan View (Info) standar dari Filament
            Tables\Actions\EditAction::make()->iconButton(),
            Tables\Actions\ViewAction::make()->icon('heroicon-o-information-circle')->iconButton(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
