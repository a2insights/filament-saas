<?php

namespace A2Insights\FilamentSaas\Middleware;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MiddlewareServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-saas.middleware');
    }
}
