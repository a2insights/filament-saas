<?php

declare(strict_types=1);

namespace A2Insights\FilamentSaas\Tenant;

use A2Insights\FilamentSaas\Facades\FilamentSaas;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TenantServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        // PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
        //     $panelSwitch
        //         ->simple()
        //         ->visible(fn (): bool => auth()->user()?->hasAnyRole([
        //             'super_admin',
        //         ]));
        // });

        if (! class_exists(FilamentSaas::getCompanyModel())) {
            return;
        }

        // TODO: Real time facades issue
        // FilamentSaas::getCompanyModel()::created(function (Model $company) {
        //     $company->run(function () {
        //         $storage_path = storage_path();

        //         mkdir("$storage_path/framework/cache", 0777, true);
        //     });
        // });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('filament-saas.user');
    }
}
