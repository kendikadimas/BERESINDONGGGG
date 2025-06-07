<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn; // Gunakan BadgeColumn untuk role
use Filament\Tables\Actions\Action; // Untuk aksi kustom
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter; // Untuk filter
use App\Filament\Resources\UserResource\Widgets\UserStatsWidget; // Impor widget


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('role')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('skill')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->label('Username')->searchable(),
            TextColumn::make('email')->searchable(),
            // Gunakan BadgeColumn agar 'role' terlihat lebih bagus
            BadgeColumn::make('role')
                ->colors([
                    'primary' => 'customer',
                    'success' => 'tukang',
                    'danger' => 'admin',
                ])
                ->searchable(),
            TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Tambahkan filter berdasarkan role
            SelectFilter::make('role')
                ->options([
                    'admin' => 'Admin',
                    'customer' => 'Customer',
                    'tukang' => 'Tukang',
                ])
        ])
        ->actions([
            Tables\Actions\EditAction::make()->icon('heroicon-o-pencil-square')->iconButton(),
            // Aksi kustom untuk verifikasi
            Action::make('verify')
                ->label('Verifikasi')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->iconButton()
                ->action(function (User $record) {
                    $record->email_verified_at = now();
                    $record->save();
                })
                // Hanya tampilkan tombol ini jika user belum diverifikasi
                ->visible(fn (User $record): bool => !$record->hasVerifiedEmail()), 
            Tables\Actions\DeleteAction::make()->icon('heroicon-o-trash')->iconButton(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
