<?php

namespace A2Insights\FilamentSaas\Settings\Filament\Pages;

use A2Insights\FilamentSaas\Settings\Settings;
use A2Insights\FilamentSaas\Settings\TermsSettings;
use Filament\Pages\BasePage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Terms extends BasePage
{
    protected ?string $maxContentWidth = 'full';

    protected static string $view = 'filament-saas::features.terms-of-service';

    public string $termsOfService;

    public function getTitle(): string | Htmlable
    {
        return __('filament-saas::default.terms-of-service.title');
    }

    public function mount()
    {
        $settings = App::make(Settings::class);

        if (! $settings->terms) {
            return redirect('/');
        }

        $termsOfService = App::make(TermsSettings::class)->service;

        $this->termsOfService = Str::markdown($termsOfService);
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
