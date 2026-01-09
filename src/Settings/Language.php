<?php

namespace A2Insights\FilamentSaas\Settings;

class Language
{
    public static function getPreferredLocale(): string
    {
        $locale = session()->get('locale') ??
            request()->get('locale') ??
            request()->cookie('filament_language_switch_locale') ??
            self::getUserPreferredLocale() ??
            config('app.locale', 'en') ??
            request()->getPreferredLanguage();

        return in_array($locale, self::getLocales(), true) ? $locale : config('app.locale');
    }

    public static function getUserPreferredLocale(): ?string
    {
        if (auth()->check() && method_exists(auth()->user(), 'getLocale')) {
            return auth()->user()->getLocale();
        }
        
        return auth()->user()->locale ?? null;
    }

    public static function getLocales(): array
    {
        return config('app.locales', ['en', 'pt_BR']);
    }
}
