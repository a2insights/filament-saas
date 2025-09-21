<?php

namespace A2Insights\FilamentSaas\Tenant;

use Filament\Contracts\Plugin;
use Filament\FilamentManager;
use Filament\Panel;

class TenantPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-saas.tenant';
    }

    /**
     * Class MyClass overrides inline block form.
     *
     * @phpstan-ignore-next-line */
    public static function get(): Plugin|FilamentManager
    {
        return filament(app(static::class)->getId());
    }

    public function boot(Panel $panel): void {}

    public function register(Panel $panel): void
    {
        $panel->resources([]);
    }
}
