<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// 1. Impor semua komponen yang ingin Anda daftarkan
use App\Filament\Tukang\Pages\Dashboard;
use App\Filament\Tukang\Resources\OrderResource;
use App\Filament\Tukang\Resources\RatingResource;
use App\Filament\Tukang\Resources\EmergencyRequestResource;

class TukangPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tukang')
            ->path('tukang')
            ->login()
            ->homeUrl('/tukang')
            ->authGuard('web')
            ->colors([
                'primary' => Color::Amber,
            ])
            // 2. Hapus semua method discover...()
            // ->discoverResources(...)
            // ->discoverPages(...)
            // ->discoverWidgets(...)

            // 3. Daftarkan semua komponen secara manual
            ->pages([
                Dashboard::class,
            ])
            ->resources([
                OrderResource::class,
                RatingResource::class,
                EmergencyRequestResource::class,
                // Tambahkan resource lain untuk panel tukang di sini
            ])
            ->widgets([
                // Daftarkan widget global di sini jika ada
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}