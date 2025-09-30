<?php

namespace A2Insights\FilamentSaas\User;

use A2Insights\FilamentSaas\User\Filament\UserResource;
use BezhanSalleh\FilamentShield\Resources\Roles\Pages\ListRoles;
use Filament\Contracts\Plugin;
use Filament\FilamentManager;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UserPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-saas.user';
    }

    /**
     * Class MyClass overrides inline block form.
     *
     * @phpstan-ignore-next-line */
    public static function get(): Plugin|FilamentManager
    {
        return filament(app(static::class)->getId());
    }

    public function boot(Panel $panel): void
    {
        if (App::runningInConsole()) {
            return;
        }
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            config('filament-saas.users.resource', UserResource::class),
        ]);
    }
}
