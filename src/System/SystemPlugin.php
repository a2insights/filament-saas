<?php

namespace A2Insights\FilamentSaas\System;

use Filament\Contracts\Plugin;
use Filament\FilamentManager;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SystemPlugin implements Plugin
{
    protected $settings;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-saas.system';
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

    public function register(Panel $panel): void {}
}
