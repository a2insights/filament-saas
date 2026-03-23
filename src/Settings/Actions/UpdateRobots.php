<?php

namespace A2Insights\FilamentSaas\Settings\Actions;
 
use A2Insights\FilamentSaas\Settings\Settings;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateRobots
{
    use AsAction;

    /**
     * Generates the sitemap based on the application settings.
     */
    public function handle(string $newContent): void
    {
        $settings = app(Settings::class);
        $settings->robots = $newContent;
        $settings->save();
    }
}
