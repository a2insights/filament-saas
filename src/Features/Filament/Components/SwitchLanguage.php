<?php

namespace A2Insights\FilamentSaas\Features\Filament\Components;

use A2Insights\FilamentSaas\Settings\Settings;
use A2Insights\FilamentSaas\User\Settings as UserSettings;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SwitchLanguage extends Component
{
    public array $locales;

    public string $locale;

    public function mount(Settings $settings)
    {
        $this->locales = $settings->locales;
        $this->locale = $settings->locale;
    }

    public function changeLocale($locale)
    {
        $user = auth()->user();

        $settings = UserSettings::from(array_merge(
            $user->settings?->toArray() ?? [],
            ['locale' => $locale]
        ));

        $user->settings = $settings;

        $key = 'filament-saas.user-settings|'.$user->id;
        cache()->forget($key);
        cache()->rememberForever($key, function () use ($settings) {
            return $settings;
        });

        $user->save();

        $this->redirect(request()->header('Referer'));
    }

    public function render(): View
    {
        return view('filament-saas::features.switch-language');
    }
}
