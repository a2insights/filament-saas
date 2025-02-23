<?php

namespace A2Insights\FilamentSaas\User\Filament\Pages;

use A2Insights\FilamentSaas\Features\Features;
use A2Insights\FilamentSaas\FilamentSaas;
use A2Insights\FilamentSaas\Settings\Settings;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as AuthRegister;
use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;
use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

/**
 * @property Form $form
 */
class Register extends AuthRegister
{
    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        $features = App::make(Features::class);
        $settings = App::make(Settings::class);

        $userPhone = $features->user_phone;
        $username = $features->username;
        $terms = $settings->terms;

        $fields = [];

        if ($username) {
            $fields[] = $this->getUsernameFormComponent();
        }

        array_push($fields, $this->getNameFormComponent(), $this->getEmailFormComponent(), $this->getPasswordFormComponent(), $this->getPasswordConfirmationFormComponent());

        if ($userPhone) {
            $fields[] = $this->getPhoneFormComponent();
        }

        if ($terms) {
            $fields[] = $this->getTermsFormComponent();
        }

        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema($fields)
                    ->statePath('data'),
            ),
        ];
    }

    private function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label(__('filament-saas::default.users.profile.username.title'))
            ->prefixIcon('heroicon-m-at-symbol')
            ->unique(FilamentSaas::getUserModel())
            ->required()
            ->rules(['required', 'max:100', 'min:4', 'string']);
    }

    private function getTermsFormComponent(): Component
    {
        $html = new HtmlString(
            trans(
                'filament-saas::default.users.register.accept_terms',
                [
                    'terms_of_service_url' => FilamentSaas::getTermsOfServiceRoute(),
                    'privacy_policy_url' => FilamentSaas::getPrivacyPolicyRoute(),
                ]
            )
        );

        return Checkbox::make('terms')
            ->label($html)
            ->required();
    }

    private function getPhoneFormComponent(): Component
    {
        return PhoneInput::make('phone')
            ->label(__('filament-saas::default.users.register.phone'))
            ->unique(FilamentSaas::getUserModel())
            ->initialCountry('BR')
            ->validateFor(
                lenient: true,
                type: PhoneNumberType::MOBILE,
            )
            ->required();
    }
}
