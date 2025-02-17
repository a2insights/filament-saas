<?php

namespace A2Insights\FilamentSaas\Features\Filament\Pages;

use A2Insights\FilamentSaas\Features\Features;
use A2Insights\FilamentSaas\Settings\reCAPTCHASettings;
use A2Insights\FilamentSaas\Settings\WhatsappChatSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Icetalker\FilamentPicker\Forms\Components\Picker;
use Illuminate\Support\Facades\App;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class FeaturesPage extends SettingsPage
{
    use HasPageShield;

    protected static string $settings = Features::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $slug = 'settings/features';

    public static function getNavigationGroup(): ?string
    {
        return __('filament-saas::default.settings.title');
    }

    public function getTitle(): string
    {
        return __('filament-saas::default.features.title');
    }

    public function getHeading(): string
    {
        return __('filament-saas::default.features.heading');
    }

    public function getSubheading(): ?string
    {
        return __('filament-saas::default.features.subheading') ?? null;
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-saas::default.features.title');
    }

    private function recaptcha()
    {
        return App::make(reCAPTCHASettings::class);
    }

    private function whatsappChat()
    {
        return App::make(WhatsappChatSettings::class);
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        // if ($data['recaptcha']) {
        //     $recaptchaSettings = $this->recaptcha();
        //     $recaptchaSettings->site_key = $data['recaptcha-site_key'];
        //     $recaptchaSettings->secret_key = $data['recaptcha-secret_key'];

        //     $recaptchaSettings->save();
        // }

        if ($data['whatsapp_chat']) {
            $whatsappChatSettings = $this->whatsappChat();
            $whatsappChatSettings->attendants = $data['whatsapp_chat-attendants'];
            $whatsappChatSettings->header = $data['whatsapp_chat-header'];
            $whatsappChatSettings->footer = $data['whatsapp_chat-footer'];

            $whatsappChatSettings->save();
        }

        cache()->forget('filament-saas.features');
        cache()->forget('filament-saas.settings');

        redirect(FeaturesPage::getUrl());
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $recaptchaSettings = $this->recaptcha();
        // $data['recaptcha-site_key'] = $recaptchaSettings->site_key;
        // $data['recaptcha-secret_key'] = $recaptchaSettings->secret_key;

        $whatsappChatSettings = $this->whatsappChat();
        $data['whatsapp_chat-attendants'] = $whatsappChatSettings->attendants;
        $data['whatsapp_chat-header'] = $whatsappChatSettings->header;
        $data['whatsapp_chat-footer'] = $whatsappChatSettings->footer;

        return $data;
    }

    protected function getFormSchema(): array
    {
        return [
            // TODO: dark_mode not work with hasnayeen themes
            // Fieldset::make('Style')
            //     ->schema([
            //         Toggle::make('dark_mode')
            //             ->hint('You can enable the toggle button for switching between light and dark mode.')
            //             ->helperText('Caution: If you enable dark mode, your site will be displayed the toggle button for switching between light and dark mode.')
            //             ->default(false),
            //     ])->columns(1),
            Section::make(__('filament-saas::default.features.user.title'))
                ->description(__('filament-saas::default.features.user.subtitle'))
                ->schema([
                    Toggle::make('auth_registration')
                        ->label(__('filament-saas::default.features.user.registration.label'))
                        ->helperText(__('filament-saas::default.features.user.registration.help_text')),
                    Toggle::make('user_phone')
                        ->label(__('filament-saas::default.features.user.phone.label'))
                        ->helperText(__('filament-saas::default.features.user.phone.help_text')),
                    Toggle::make('username')
                        ->label(__('filament-saas::default.features.user.username.label'))
                        ->helperText(__('filament-saas::default.features.user.username.help_text')),
                    Toggle::make('switch_language')
                        ->label(__('filament-saas::default.features.user.switch_language.label'))
                        ->helperText(__('filament-saas::default.features.user.switch_language.help_text')),
                    // TODO: Make this configurable
                    // Toggle::make('auth_login')
                    //     ->label('Login')
                    //     ->hint('You can disable login to your site.')
                    //     ->helperText('Caution: If you disable login, users will not be able to login to your site.'),
                    // //TODO: Make this configurable
                    // Toggle::make('auth_2fa')
                    //     ->label('2FA')
                    //     ->hint('You can enable 2FA to your site.')
                    //     ->helperText('Caution: If you enable 2FA, users will can enable 2FA to their account.'),
                    // // TODO: Implement feature and Make this configurable
                    // Toggle::make('recaptcha')
                    //     ->label('reCAPTCHA')
                    //     ->reactive()
                    //     ->hint('You can enable reCAPTCHA to your site.')
                    //     ->helperText('Caution: If you enable reCAPTCHA, users will login with reCAPTCHA.'),
                    // TextInput::make('recaptcha-site_key')
                    //     ->label('reCAPTCHA Site Key')
                    //     ->required(fn($state, callable $get) => $get('recaptcha'))
                    //     ->visible(fn($state, callable $get) => $get('recaptcha'))
                    //     ->hint('You can set reCAPTCHA site key to your site.'),
                    // TextInput::make('recaptcha-secret_key')
                    //     ->label('reCAPTCHA Secret Key')
                    //     ->required(fn($state, callable $get) => $get('recaptcha'))
                    //     ->visible(fn($state, callable $get) => $get('recaptcha'))
                    //     ->hint('You can set reCAPTCHA secret key to your site.'),
                ])
                ->collapsed()
                ->columns(1),
            Section::make(__('filament-saas::default.features.whatsapp_chat.title'))
                ->description(__('filament-saas::default.features.whatsapp_chat.subtitle'))
                ->schema([
                    Toggle::make('whatsapp_chat')
                        ->label(__('filament-saas::default.features.whatsapp_chat.active.label'))
                        ->reactive(),
                    Group::make()
                        ->schema([
                            TextInput::make('whatsapp_chat-header')
                                ->label(__('filament-saas::default.features.whatsapp_chat.header.label'))
                                ->maxLength(200)
                                ->required()
                                ->columnSpan(4),
                            TextInput::make('whatsapp_chat-footer')
                                ->label(__('filament-saas::default.features.whatsapp_chat.footer.label'))
                                ->maxLength(100)
                                ->columnSpan(4),
                        ])
                        ->visible(fn ($state, callable $get) => $get('whatsapp_chat'))
                        ->columns(8),
                    Repeater::make('whatsapp_chat-attendants')
                        ->label(__('filament-saas::default.features.whatsapp_chat.attendants.title'))
                        ->schema([
                            FileUpload::make('avatar.src')
                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.avatar.label'))
                                ->avatar()
                                ->columns(1),
                            Group::make()
                                ->schema([
                                    Group::make()
                                        ->schema([
                                            TextInput::make('name')
                                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.name.label'))
                                                ->required()
                                                ->maxLength(30)
                                                ->columnSpan(7),
                                            Toggle::make('active')
                                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.active.label'))
                                                ->default(true)
                                                ->inline(false)
                                                ->columnSpan(1),
                                        ])
                                        ->columns(8),
                                    Group::make()
                                        ->schema([
                                            TextInput::make('label')
                                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.label.label'))
                                                ->required()
                                                ->maxLength(20)
                                                ->columnSpan(3),
                                            PhoneInput::make('number')
                                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.phone.label'))
                                                ->initialCountry('BR')
                                                ->inputNumberFormat(PhoneInputNumberType::NATIONAL)
                                                ->validateFor(
                                                    lenient: true,
                                                    type: PhoneNumberType::MOBILE,
                                                    country: 'BR',
                                                )
                                                ->columnSpan(2),
                                        ])
                                        ->columns(5),
                                ])
                                ->columnSpan(6),
                            Picker::make('avatar.icon')
                                ->label(__('filament-saas::default.features.whatsapp_chat.attendants.icon.label'))
                                ->options(fn (): array => collect(array_fill(1, 30, null))->mapWithKeys(fn ($value, $key) => ["/img/avatars/avatar-$key.svg" => ''])->toArray())
                                ->imageSize(50)
                                ->images(fn (): array => collect(array_fill(1, 30, null))->mapWithKeys(fn ($value, $key) => ["/img/avatars/avatar-$key.svg" => "/img/avatars/avatar-$key.svg"])
                                    ->toArray())
                                ->columnSpanFull(),
                        ])
                        ->visible(fn ($state, callable $get) => $get('whatsapp_chat'))
                        ->collapsed()
                        ->defaultItems(2)
                        ->columns(7),
                ])
                ->collapsed()
                ->columns(1),
        ];
    }
}
