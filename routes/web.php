<?php

use A2Insights\FilamentSaas\Settings\Settings;
use Illuminate\Support\Facades\Route;

Route::get('robots.txt', function () {
    $settings = app(Settings::class);
    $currentDomain = request()->getHost();
    $allowedDomains = config('filament-saas.robots_allowed_domains', []);

    if (! in_array($currentDomain, $allowedDomains)) {
        return response("User-agent: *\nDisallow: /", 200)
            ->header('Content-Type', 'text/plain');
    }

    $robots = $settings->robots;

    if (! empty($robots)) {
        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }

    if (file_exists(public_path('robots.default.txt'))) {
        return response(file_get_contents(public_path('robots.default.txt')), 200)
            ->header('Content-Type', 'text/plain');
    }

    return response("User-agent: *\nDisallow:", 200)
        ->header('Content-Type', 'text/plain');
});
