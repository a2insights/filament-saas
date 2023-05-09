<?php

namespace Octo\Settings\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Artisan;
use Livewire\TemporaryUploadedFile;
use Octo\Settings\Settings;

class MainSettingsPage extends SettingsPage
{
    protected static string $settings = Settings::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'settings/main';

    protected static ?string $title = 'Main Settings';

    protected ?string $heading = 'Main Settings';

    protected ?string $subheading = 'Update your main settings.';

    protected function getRedirectUrl(): ?string
    {
        return '/dashboard/settings/main';
    }

    protected function afterSave(): void
    {
        Artisan::call('route:clear');
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Metadata')
                ->schema([
                    TextInput::make('name'),
                    TagsInput::make('keywords')->suggestions([
                        'tailwindcss',
                        'alpinejs',
                        'laravel',
                        'livewire',
                    ]),
                    Textarea::make('description')->rows(2),
                ])->columns(1),
            Fieldset::make('Style')
                ->schema([
                    Toggle::make('dark_mode')
                        ->hint('You can enable the toggle button for switching between light and dark mode.')
                        ->helperText('Caution: If you enable dark mode, your site will be displayed the toggle button for switching between light and dark mode.')
                        ->default(false),
                    FileUpload::make('logo')->image()->directory('images')->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return 'logo.'.$file->guessExtension();
                    }),
                    FileUpload::make('favicon')->image()->directory('images')->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return 'favicon.'.$file->guessExtension();
                    }),
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
            Fieldset::make('Security')
                ->schema([
                    TagsInput::make('restrict_ips')
                        ->hint('You can restrict access to your site by IP address.')
                        ->helperText('Caution: If you block your own IP address, you will be locked out of your site. And you will have to manually remove your IP address from the database or access from another IP address.')
                        ->suggestions([
                            request()->ip(),
                        ]),
                    Select::make('restrict_users')
                        ->multiple()
                        ->searchable()
                        ->hint('You can restrict access to your site by user.')
                        ->helperText('Caution: If you block your own user, you will be locked out of your site. And you will have to manually remove your user from the database or access from another user.')
                        ->options(fn () => User::all()->pluck('name', 'id'))
                        ->getSearchResultsUsing(fn (string $search) => User::where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name),
                ])->columns(1),
        ];
    }
}
