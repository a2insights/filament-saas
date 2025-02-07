<?php

namespace A2Insights\FilamentSaas;

use A2Insights\FilamentSaas\Commands\FilamentSaasCommand;
use A2Insights\FilamentSaas\Features\FeaturesServiceProvider;
use A2Insights\FilamentSaas\Middleware\MiddlewareServiceProvider;
use A2Insights\FilamentSaas\Settings\SettingsServiceProvider;
use A2Insights\FilamentSaas\System\SystemServiceProvider;
use A2Insights\FilamentSaas\Tenant\TenantServiceProvider;
use A2Insights\FilamentSaas\Testing\TestsFilamentSaas;
use A2Insights\FilamentSaas\User\UserServiceProvider;
use A2Insights\FilamentSaas\Webhook\WebhookServiceProvider;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSaasServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-saas';

    public static string $viewNamespace = 'filament-saas';

    public function bootingPackage()
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(FeaturesServiceProvider::class);
        $this->app->register(SettingsServiceProvider::class);
        $this->app->register(SystemServiceProvider::class);
        $this->app->register(MiddlewareServiceProvider::class);
        $this->app->register(TenantServiceProvider::class);
        $this->app->register(WebhookServiceProvider::class);

        FilamentAsset::register([
            Css::make('filament-banner', base_path('vendor/kenepa/banner/resources/dist/banner.css')),
        ]);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands());
        // ->hasInstallCommand(function (InstallCommand $command) {
        //     $command
        //         ->publishConfigFile()
        //         ->publishMigrations()
        //         ->askToRunMigrations()
        //         ->askToStarRepoOnGitHub('A2Insights/filament-saas');
        // });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        // if (file_exists($package->basePath('/../resources/views'))) {
        //     $package->hasViews(static::$viewNamespace);
        // }
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-saas/{$file->getFilename()}"),
                ], 'filament-saas-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentSaas);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'A2Insights/filament-saas';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-saas', __DIR__ . '/../resources/dist/components/filament-saas.js'),
            // Css::make('filament-saas-styles', __DIR__ . '/../resources/dist/filament-saas.css'),
            // Js::make('filament-saas-scripts', __DIR__ . '/../resources/dist/filament-saas.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [FilamentSaasCommand::class];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [];
    }
}
