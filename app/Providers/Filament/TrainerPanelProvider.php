<?php

namespace App\Providers\Filament;

use App\Filament\Trainer\Widgets\StatOverview;
use App\Models\User;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
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
use Jeffgreco13\FilamentBreezy\BreezyCore;

class TrainerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('trainer')
            ->path('trainer')
            ->colors([
                'primary' => Color::hex('#fa532e'),
                'blue' => Color::Blue,
            ])
            ->brandLogo(asset('logo/red-logo.png'))
            ->darkModeBrandLogo(asset('logo/white-logo.png'))
            ->brandLogoHeight('4rem')
            ->login()
            ->plugins([
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled()
                    ->users(fn() => User::pluck('email', 'name')->toArray())
            ])
            ->plugin(BreezyCore::make()
                ->myProfile()
                ->enableTwoFactorAuthentication())
            ->discoverResources(in: app_path('Filament/Trainer/Resources'), for: 'App\\Filament\\Trainer\\Resources')
            ->discoverPages(in: app_path('Filament/Trainer/Pages'), for: 'App\\Filament\\Trainer\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Trainer/Widgets'), for: 'App\\Filament\\Trainer\\Widgets')
            ->widgets([
                StatOverview::class
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
