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
use App\Filament\Tukang\Widgets\TukangServiceStats; // Impor widget
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;

class ManageMyServices extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'Layanan';
    protected static string $view = 'filament.tukang.pages.manage-my-services';

    public Collection $myServices;

    public function mount(): void
    {
        $this->myServices = Auth::user()
            ->offeredServices()
            ->where('status', 'approved')
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
                ->form([
                    Select::make('service_category_id')
                        ->label('Pilih Kategori Layanan')
                        ->options(ServiceCategory::pluck('name', 'id'))
                        ->live() // Membuat field ini reaktif
                        ->required(),
                    Select::make('service_id')
                        ->label('Pilih Layanan')
                        ->options(function (callable $get) {
                            $category = ServiceCategory::find($get('service_category_id'));
                            if (!$category) {
                                return [];
                            }
                            return $category->services->pluck('name', 'id');
                        })
                        ->required(),
                    Textarea::make('description')
                        ->label('Tambahkan Deskripsi Layanan')
                        ->rows(4)
                        ->required(),
                    TextInput::make('price')
                        ->label('Harga yang Anda Tawarkan')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),
                ])
                ->action(function (array $data) {
                    Auth::user()->offeredServices()->attach($data['service_id'], [
                        'description' => $data['description'],
                        'price' => $data['price'],
                        'status' => 'pending', // Layanan baru perlu approval admin
                    ]);

                    Notification::make()
                        ->title('Layanan berhasil ditambahkan dan menunggu persetujuan admin.')
                        ->success()
                        ->send();
                    
                    // Refresh data di halaman
                    $this->mount();
                }),
        ];
    }
}