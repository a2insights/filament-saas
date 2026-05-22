<?php

namespace A2Insights\FilamentSaas\Settings\Actions;

use A2Insights\FilamentSaas\Settings\Settings;

class UpdateRobots
{
    /**
     * Generates the sitemap based on the application settings.
     */
    public static function run(string $newContent): void
    {
        app(static::class)->handle($newContent);
    }

    public function handle(string $newContent): void
    {
        $settings = app(Settings::class);
        $settings->robots = $newContent;
        $settings->save();
    }
}
