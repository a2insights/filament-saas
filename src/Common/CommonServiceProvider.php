<?php
namespace Octo\Common;

use Filament\PluginServiceProvider;
use Octo\Common\Filament\ContactResource;
use Spatie\LaravelPackageTools\Package;

class CommonServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        ContactResource::class,
    ];

    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function configurePackage(Package $package): void
    {
        $package->name('octo.common');
    }
}
