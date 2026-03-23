<?php

use A2Insights\FilamentSaas\Settings\Settings;
use Illuminate\Support\Facades\Route;

Route::get('robots.txt', function () {
    $robots = app(Settings::class)->robots;

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
