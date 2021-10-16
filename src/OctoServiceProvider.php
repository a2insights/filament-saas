<?php

namespace Octo;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Octo\Http\Livewire\DropdownNotifications;
use Octo\Http\Livewire\ListNotifications;
use Octo\Http\Livewire\Subscribe;
use Octo\Resources\Components\Sidebar;

class OctoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/octo.php' => config_path('octo.php'),
        ], 'octo-config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'octo');

        // Octo components
        Blade::component('octo::sidebar', Sidebar::class);
        Blade::component('octo::components.hero','octo-hero');
        Blade::component('octo::components.tile','octo-tile');

        // Need publish
        Blade::component('footer','footer');

        // Global
        Blade::component('octo::components.global.action-link','action-link');
        Blade::component('octo::components.global.bitbucket-icon','bitbucket-icon');
        Blade::component('octo::components.global.connected-account','connected-account');
        Blade::component('octo::components.global.github-icon','github-icon');
        Blade::component('octo::components.global.gitlab-icon','gitlab-icon');
        Blade::component('octo::components.global.facebook-icon','facebook-icon');
        Blade::component('octo::components.global.facebook-icon','linked-in-icon');
        Blade::component('octo::components.global.google-icon','google-icon');
        Blade::component('octo::components.global.twitter-icon','twitter-icon');
        Blade::component('octo::components.global.socialstream-providers','socialstream-providers');

        // Livewire
        Livewire::component('octo-subscribe', Subscribe::class);
        Livewire::component('octo-dropdown-notifications', DropdownNotifications::class);
        Livewire::component('octo-list-notifications', ListNotifications::class);

        // Share views data
        View::share('sidebar',  ['items' => config('octo.navigation.sidebar')]);

        // Configure commmands
        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/octo.php', 'octo'
        );
    }
}
