<?php

namespace A2Insights\FilamentSaas\Settings;

use Spatie\LaravelSettings\Settings as BaseSettings;

class Settings extends BaseSettings
{
    public string $name;

    public string $description;

    public array $keywords;

    public ?string $head;

    public ?string $logo;

    public ?string $og;

    public ?string $logo_size;

    public ?string $favicon;

    public bool $terms;
    
    public ?string $robots;

    public bool $sitemap;

    public array $restrict_ips;

    public array $restrict_users;

    public string $timezone;

    public string $locale;

    public array $locales;

    public static function group(): string
    {
        return 'settings';
    }
}
