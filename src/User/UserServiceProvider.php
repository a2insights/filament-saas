<?php

namespace A2Insights\FilamentSaas\User;

use A2Insights\FilamentSaas\User\Filament\Components\Phone;
use A2Insights\FilamentSaas\User\Filament\Components\Username;
use A2Insights\FilamentSaas\User\Filament\Pages\BannedUser;
use A2Insights\FilamentSaas\User\Filament\Pages\Register;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UserServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        $this->registerLivewireComponents();

        // TODO: BannedUser needs to be upgraded
        // Route::get('banned/user', BannedUser::class)
        //     ->middleware('web')
        //     ->name('banned.user');

        // Fix recaptcha style
        // TODO: Implement Recaptcha style fix
        // Filament::registerRenderHook(
        //     'body.start',
        //     fn (): string => '<style>.g-recaptcha { margin: 0 auto;display: table }</style>'
        // );
    }

    public function configurePackage(Package $package): void
    {
        $package->name('filament-saas.user');
    }

    public function registerLivewireComponents(): void
    {
        // TODO: BannedUser needs to be upgraded
        // Livewire::component('BannedUser', BannedUser::class);
        Livewire::component('Register', Register::class);
        Livewire::component('phone', Phone::class);
        Livewire::component('username', Username::class);
    }
}
