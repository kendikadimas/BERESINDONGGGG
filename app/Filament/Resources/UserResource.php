<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true)->maxLength(255),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'customer' => 'Customer',
                        'tukang' => 'Tukang',
                    ])
                    ->required()->native(false)->live(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                
                Forms\Components\Section::make('Informasi Tukang')
                    ->collapsible()
                    ->visible(fn (Forms\Get $get): bool => $get('role') === 'tukang')
                    ->schema([
                        Forms\Components\FileUpload::make('avatar_path')->label('Foto Profil')->image()->disk('public')->directory('avatars'),
                        Forms\Components\FileUpload::make('identity_document_path')->label('Dokumen Identitas')->disk('public')->directory('identity-documents'),
                        Forms\Components\TextInput::make('phone')->tel(),
                        Forms\Components\Textarea::make('address')->columnSpanFull(),
                        Forms\Components\TextInput::make('skill'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // HAPUS ->tabs([...]) DAN GANTI DENGAN ->filters([...])
            ->filters([
                Tables\Filters\Filter::make('pending_partners')
                    ->label('Ajuan Mitra Pending')
                    ->query(function (Builder $query): Builder {
                        return $query->whereHas('partnerApplications', function (Builder $q) {
                            $q->where('status', 'pending');
                        });
                    }),
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_path')->label('Foto')->disk('public')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Username')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\BadgeColumn::make('role')->colors([
                    'primary' => 'customer',
                    'success' => 'tukang',
                    'danger' => 'admin',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('review_application')
                    ->label('Review Ajuan')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->color('info')
                    ->visible(fn (User $record): bool => $record->partnerApplications()->where('status', 'pending')->exists())
                    ->modalSubmitActionLabel('Setujui')
                    ->infolist([
                        Infolists\Components\ImageEntry::make('partnerApplications.profile_photo_path')->label('Foto Profil Diajukan')->disk('public'),
                        Infolists\Components\ImageEntry::make('partnerApplications.identity_document_path')->label('Dokumen Identitas (KTP)')->disk('public'),
                    ])
                    ->action(function (User $record) {
                        $application = $record->partnerApplications()->where('status', 'pending')->first();
                        if ($application) {
                            $record->update([
                                'role' => 'tukang',
                                'avatar_path' => $application->profile_photo_path
                            ]);
                            $application->update(['status' => 'approved']);
                            Notification::make()->title('Mitra berhasil disetujui!')->success()->send();
                        }
                    })
                    ->extraModalActions([
                        Tables\Actions\Action::make('reject')
                            ->label('Tolak')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->action(function (User $record) {
                                $application = $record->partnerApplications()->where('status', 'pending')->first();
                                if ($application) {
                                    $application->update(['status' => 'rejected']);
                                    Notification::make()->title('Pengajuan berhasil ditolak.')->warning()->send();
                                }
                            })
                    ]),
            ]);
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