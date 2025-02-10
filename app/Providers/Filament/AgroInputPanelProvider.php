<?php

namespace App\Providers\Filament;

use App\Models\Team;
use Filament\Enums\ThemeMode;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AgroInputPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('agro-input')
            ->path('agro-input')
            // ->login()
            ->colors([
                'primary' => '#287e36',
                'danger' => '#dc3545',
            ])
            ->defaultThemeMode(ThemeMode::Dark)
            ->favicon(asset('logos/farmex.png'))
            ->brandLogo('https://farmex.extensionafrica.com/assets/farmex-logo-main-with-tagline.png')
            ->brandLogoHeight('3rem')
            ->discoverResources(in: app_path('Filament/AgroInput/Resources'), for: 'App\\Filament\\AgroInput\\Resources')
            ->discoverPages(in: app_path('Filament/AgroInput/Pages'), for: 'App\\Filament\\AgroInput\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/AgroInput/Widgets'), for: 'App\\Filament\\AgroInput\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
