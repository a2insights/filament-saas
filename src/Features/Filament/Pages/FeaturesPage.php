<?php

namespace Octo\Features\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Artisan;
use Octo\Features\Features;

class FeaturesPage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = Features::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-grid-add';

    protected static ?string $navigationGroup = 'System';

    protected static ?string $slug = 'features';

    protected static ?string $title = 'Features';

    protected ?string $heading = 'Featuress';

    protected ?string $subheading = 'Manage your features.';

    protected function getRedirectUrl(): ?string
    {
        return '/dashboard/features';
    }

    protected function afterSave(): void
    {
        Artisan::call('route:clear');
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Style')
                ->schema([
                    Toggle::make('dark_mode')
                        ->hint('You can enable the toggle button for switching between light and dark mode.')
                        ->helperText('Caution: If you enable dark mode, your site will be displayed the toggle button for switching between light and dark mode.')
                        ->default(false),
                ])->columns(1),
            Fieldset::make('Authentication')
                ->schema([
                    Toggle::make('auth_registration')
                        ->label('Registration')
                        ->hint('You can disable registration to your site.')
                        ->helperText('Caution: If you disable registration, users will not be able to register to your site.'),
                    Toggle::make('auth_login')
                        ->label('Login')
                        ->hint('You can disable login to your site.')
                        ->helperText('Caution: If you disable login, users will not be able to login to your site.'),
                    Toggle::make('auth_2fa')
                        ->label('2FA')
                        ->hint('You can enable 2FA to your site.')
                        ->helperText('Caution: If you enable 2FA, users will can enable 2FA to their account.'),
                ])->columns(1),
            Fieldset::make('Developer')
                ->schema([
                    Toggle::make('webhooks')
                        ->label('Webhooks')
                        ->hint('You can enable webhooks to your site.')
                        ->helperText('Caution: If you enable webhooks, users will can enable webhooks to their account.'),
                ])->columns(1),
        ];
    }
}
