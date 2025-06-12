<?php

namespace App\Filament\Tukang\Resources;

use App\Filament\Tukang\Resources\RatingResource\Pages;
use App\Models\Rating;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';

    // Method ini memastikan tukang hanya melihat rating miliknya
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('tukang_id', auth()->id());
    }

    // Konfigurasi tabel Anda yang sudah benar
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.service.name')->label('Pesanan'),
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->date('d M Y'),
                Tables\Columns\TextColumn::make('rating')->label('Rating')->suffix(' ★'),
                Tables\Columns\TextColumn::make('review')->label('Detail')->limit(30)->tooltip(fn ($record) => $record->review),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton()->label('Detail'),
            ]);
    }
    
    // Konfigurasi infolist Anda yang sudah benar
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('order.service.name')->label('Layanan pada Pesanan'),
            TextEntry::make('customer.name')->label('Rating dari Customer'),
            TextEntry::make('rating')->label('Jumlah Bintang')->suffix(' ★'),
            TextEntry::make('created_at')->label('Tanggal Rating')->dateTime(),
            TextEntry::make('review')->label('Pesan/Komentar')->columnSpanFull(),
        ]);
    }
    
    // Method getPages() ini sekarang valid karena merujuk ke file yang ada
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            // 'create' => Pages\CreateRating::route('/create'), // kita tidak butuh ini
            // 'edit' => Pages\EditRating::route('/{record}/edit'), // kita tidak butuh ini
            'view' => Pages\ViewRating::route('/{record}'),
        ];
    }
    
    // Kita tidak butuh form karena tukang tidak bisa membuat rating
    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }
}