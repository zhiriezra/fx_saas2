<?php

namespace App\Providers\Filament;

use App\Filament\AgroInput\Pages\ChangePasswordPage;
use App\Models\Team;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('agro-processors')
            ->path('agro-processors')
            ->login()
            ->favicon(asset('logos/farmex.png'))
            ->brandLogo('https://farmex.extensionafrica.com/images/farmex-logo-main-with-tagline.png')
            ->brandLogoHeight('3rem')
            ->profile()
            ->navigationGroups([
                'Aggregations',
                'Sales Information',
                'Value-chain Information'
            ])
            ->userMenuItems([
                MenuItem::make()
                ->url(fn (): string => ChangePasswordPage::getUrl())
                ->label('Change Password')
                ->icon('heroicon-o-lock-closed')

            ])
            ->colors([
                'primary' => '#287e36',
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])
            ->tenant(Team::class, ownershipRelationship: 'team')
            ->tenant(Team::class, slugAttribute: 'slug');
    }
}
