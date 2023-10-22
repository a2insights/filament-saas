<?php

namespace Octo\User;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Octo\User\Filament\Components\Phone;
use Octo\User\Filament\Components\Username;
use Octo\User\Filament\Pages\BannedUser;
use Octo\User\Filament\Pages\Login;
use Octo\User\Filament\Pages\Register;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UserServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        User::observe(UserObserver::class);

        Livewire::component('BannedUser', BannedUser::class);
        Livewire::component('Login', Login::class);
        Livewire::component('Register', Register::class);
        Livewire::component('phone', Phone::class);
        Livewire::component('username', Username::class);

        Route::get('banned/user', BannedUser::class)
            ->middleware('web')
            ->name('banned.user');

        // Fix recaptcha style
        Filament::registerRenderHook(
            'body.start',
            fn (): string => '<style>.g-recaptcha { margin: 0 auto;display: table }</style>'
        );
    }

    public function configurePackage(Package $package): void
    {
        $package->name('octo.user');
    }
}
