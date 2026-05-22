<?php

use A2Insights\FilamentSaas\User\UserPreferences;

test('user preferences has default values', function () {
    $prefs = new UserPreferences;

    expect($prefs->app_theme)->toBe('default')
        ->and($prefs->navigation_layout)->toBe('sidebar')
        ->and($prefs->zoom_level)->toBe(100)
        ->and($prefs->show_alerts_globally)->toBeTrue();
});

test('user preferences can be instantiated with custom values', function () {
    $prefs = new UserPreferences(
        app_theme: 'dark',
        navigation_layout: 'top',
        zoom_level: 120,
        show_alerts_globally: false
    );

    expect($prefs->app_theme)->toBe('dark')
        ->and($prefs->navigation_layout)->toBe('top')
        ->and($prefs->zoom_level)->toBe(120)
        ->and($prefs->show_alerts_globally)->toBeFalse();
});
