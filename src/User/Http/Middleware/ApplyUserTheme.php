<?php

declare(strict_types=1);

namespace A2Insights\FilamentSaas\User\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

/**
 * Conditionally applies a Filament theme based on the user's `preferences.app_theme`.
 *
 * Registered in ->authMiddleware() of all panels.
 *
 * Supported themes:
 *  - 'neobrutalism' → caresome/filament-neobrutalism-theme (CSS only)
 *  - 'brisk'        → filafly/brisk (CSS + Kumbh Sans font via HEAD render hook)
 */
class ApplyUserTheme
{
    public function handle(Request $request, Closure $next): Response
    {
        $theme = Auth::user()?->preferences?->app_theme;

        if ($theme === 'neobrutalism') {
            FilamentAsset::register([
                Css::make(
                    'neobrutalism-theme',
                    base_path('vendor/caresome/filament-neobrutalism-theme/resources/css/theme.css')
                ),
            ], 'caresome/filament-neobrutalism-theme');
        }

        if ($theme === 'brisk') {
            FilamentAsset::register([
                Css::make(
                    'brisk-theme',
                    Vite::asset('resources/css/filament/brisk/theme.css')
                ),
            ]);
        }

        if ($theme === 'aberdeen') {
            FilamentAsset::register([
                Css::make(
                    'aberdeen-theme',
                    Vite::asset('resources/css/filament/aberdeen/theme.css')
                ),
            ]);
        }

        if ($theme === 'inverness') {
            FilamentAsset::register([
                Css::make(
                    'inverness-theme',
                    Vite::asset('resources/css/filament/inverness/theme.css')
                ),
            ]);
        }

        if ($theme === 'edinburgh') {
            FilamentAsset::register([
                Css::make(
                    'edinburgh-theme',
                    Vite::asset('resources/css/filament/edinburgh/theme.css')
                ),
            ]);
        }

        // if ($theme === 'awin') {
        //     FilamentAsset::register([
        //         Css::make(
        //             'awin-theme',
        //             Vite::asset('resources/css/filament/awin/theme.css')
        //         ),
        //     ]);
        // }

        FilamentAsset::register([
            Css::make(
                'sysadmin-theme',
                Vite::asset('resources/css/filament/sysadmin/theme.css')
            ),
        ]);

        return $next($request);
    }
}
