<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Filament\Infolists; // <-- Impor Infolists

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'customer' => 'Customer',
                        'tukang' => 'Tukang',
                    ])
                    ->required()->native(false),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                // ... tambahkan field lain jika perlu diedit admin
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->tabs([
                'all' => Tables\Tabs\Tab::make('Semua User'),
                'pending_partners' => Tables\Tabs\Tab::make('Ajuan Mitra Pending')
                    ->badge(User::whereHas('partnerApplications', fn ($query) => $query->where('status', 'pending'))->count())
                    ->modifyQueryUsing(function (Builder $query) {
                        $query->whereHas('partnerApplications', function (Builder $q) {
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

                // Aksi untuk me-review ajuan
                Tables\Actions\Action::make('review_application')
                    ->label('Review Ajuan')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->color('info')
                    ->visible(fn (User $record): bool => $record->partnerApplications()->where('status', 'pending')->exists())
                    ->modalSubmitActionLabel('Setujui')
                    ->infolist([
                        // Ambil data dari relasi 'partnerApplications'
                        Infolists\Components\ImageEntry::make('partnerApplications.profile_photo_path')
                            ->label('Foto Profil Diajukan')->disk('public'),
                        Infolists\Components\ImageEntry::make('partnerApplications.identity_document_path')
                            ->label('Dokumen Identitas (KTP)')->disk('public'),
                    ])
                    ->action(function (User $record) {
                        $application = $record->partnerApplications()->where('status', 'pending')->first();
                        if ($application) {
                            $record->update(['role' => 'tukang']);
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
                            ->cancel(),
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