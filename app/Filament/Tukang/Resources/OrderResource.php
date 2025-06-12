<?php

namespace App\Filament\Tukang\Resources;

use App\Filament\Tukang\Resources\OrderResource\Pages;
use App\Filament\Tukang\Resources\OrderResource\RelationManagers;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tukang_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('schedule')
                    ->required(),
                Forms\Components\Textarea::make('problem_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('original_tukang_id')
                    ->numeric()
                    ->default(null),
            ]);
    }

    // app/Filament/Tukang/Resources/OrderResource.php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('customer.name')->label('Customer')->searchable(),
            Tables\Columns\TextColumn::make('service.name')->label('Layanan'),
            Tables\Columns\TextColumn::make('problem_description')->label('Detail Masalah')->limit(30),
            Tables\Columns\TextColumn::make('customer.address')->label('Lokasi')->limit(20),
            Tables\Columns\TextColumn::make('schedule')->label('Jadwal')->dateTime('d M Y'),
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->icon('heroicon-o-pencil-square')->iconButton(), // Untuk melihat detail

            // Aksi Tolak Pesanan
            Tables\Actions\Action::make('reject')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->iconButton()
                ->requiresConfirmation()
                ->action(fn (Order $record) => $record->update(['status' => 'cancelled']))
                ->visible(fn (Order $record) => $record->status === 'pending'),

            // Aksi Terima Pesanan
            Tables\Actions\Action::make('accept')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->iconButton()
                ->requiresConfirmation()
                ->action(fn (Order $record) => $record->update(['status' => 'ongoing']))
                ->visible(fn (Order $record) => $record->status === 'pending'),

             // Aksi Selesaikan Pesanan
             Tables\Actions\Action::make('complete')
                ->label('Selesaikan')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->iconButton()
                ->requiresConfirmation()
                ->action(fn (Order $record) => $record->update(['status' => 'completed']))
                ->visible(fn (Order $record) => $record->status === 'ongoing'),
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
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('tukang_id', auth()->id());
}
}
