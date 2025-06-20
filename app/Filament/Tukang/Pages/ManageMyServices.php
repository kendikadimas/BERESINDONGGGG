<?php

namespace App\Filament\Tukang\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Filament\Tukang\Widgets\TukangServiceStats;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection; // <-- Impor Collection

class ManageMyServices extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Layanan';
    protected static string $view = 'filament.tukang.pages.manage-my-services';

    // DEKLARASIKAN PROPERTI INI SEBAGAI PUBLIC
    public ?Collection $myServices;

    // Method mount() akan mengisi data ke properti di atas
    public function mount(): void
    {
        $this->myServices = Auth::user()
            ->offeredServices()
            ->wherePivot('status', 'approved') // Gunakan wherePivot()
            ->get();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TukangServiceStats::class,
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('addService')
                ->label('Tambahkan Layanan Anda')
                ->modalHeading('Tambah Penawaran Layanan Baru')
                ->form([
                    Select::make('service_category_id')
                        ->label('Pilih Kategori Layanan')
                        ->options(ServiceCategory::pluck('name', 'id'))
                        ->live()
                        ->required(),
                    Select::make('service_id')
                        ->label('Pilih Layanan')
                        ->options(function (callable $get) {
                            $category = ServiceCategory::find($get('service_category_id'));
                            return $category ? $category->services->pluck('name', 'id') : [];
                        })
                        ->searchable()
                        ->required(),
                    Textarea::make('description')->label('Deskripsi Layanan Anda')->rows(4)->required(),
                    TextInput::make('price')->label('Harga yang Anda Tawarkan')->numeric()->prefix('Rp')->required(),
                ])
                ->action(function (array $data) {
                    $user = Auth::user();
                    $isAlreadyOffered = $user->offeredServices()->where('service_id', $data['service_id'])->exists();

                    if ($isAlreadyOffered) {
                        Notification::make()->title('Layanan Sudah Ada')->warning()->send();
                        return;
                    }

                    $user->offeredServices()->attach($data['service_id'], [
                        'description' => $data['description'],
                        'price' => $data['price'],
                        'status' => 'approved',
                    ]);

                    Notification::make()->title('Layanan baru berhasil ditambahkan!')->success()->send();
                }),
        ];
    }

    // Method table() ini akan menampilkan data dan menanganinya
    public function table(Table $table): Table
    {
        return $table
            ->query(Auth::user()->offeredServices()->getQuery())
            ->heading('Layanan yang Anda Tawarkan')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Layanan'),
                Tables\Columns\TextColumn::make('pivot.description')->label('Deskripsi Anda')->limit(40)->wrap(),
                Tables\Columns\TextColumn::make('pivot.price')->label('Harga Anda')->money('IDR'),
                Tables\Columns\BadgeColumn::make('pivot.status')->label('Status')
                    ->colors(['success' => 'approved']),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->form([
                    Textarea::make('description')->required(),
                    TextInput::make('price')->numeric()->prefix('Rp')->required(),
                ]),
                Tables\Actions\DetachAction::make(), // Gunakan DetachAction untuk relasi many-to-many
            ])
            ->emptyStateHeading('Belum ada layanan yang ditawarkan')
            ->emptyStateDescription('Silakan tambahkan layanan yang ingin Anda tawarkan.');
    }
}