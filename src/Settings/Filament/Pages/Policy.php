<?php

namespace A2Insights\FilamentSaas\Settings\Filament\Pages;

use A2Insights\FilamentSaas\Settings\Settings;
use A2Insights\FilamentSaas\Settings\TermsSettings;
use Filament\Pages\BasePage;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Policy extends BasePage
{
    protected Width|string|null $maxContentWidth = 'full';

    protected string $view = 'filament-saas::features.privacy-policy';

    public string $privacyPolicy;

    public function getTitle(): string|Htmlable
    {
        return __('filament-saas::default.privacy-policy.title');
    }

    public function mount()
    {
        $settings = App::make(Settings::class);

        if (! $settings->terms) {
            return redirect('/');
        }

        $privacyPolicy = App::make(TermsSettings::class)->privacy_policy;

        $this->privacyPolicy = Str::markdown($privacyPolicy);
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
