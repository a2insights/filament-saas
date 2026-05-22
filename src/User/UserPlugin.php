<?php

namespace A2Insights\FilamentSaas\User;

use A2Insights\FilamentSaas\User\Filament\UserResource;
use Filament\Contracts\Plugin;
use Filament\FilamentManager;
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
    public static function get(): Plugin | FilamentManager
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
        $panel->topNavigation(function () {
            $user = Auth::user();
            $layout = $user?->preferences?->navigation_layout;

            if ($layout) {
                return $layout === 'top';
            }

            return false;
        })->resources([
            config('filament-saas.user.resource', UserResource::class),
        ]);
    }
}
