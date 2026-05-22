<?php

namespace A2Insights\FilamentSaas\Middleware\Http\Middleware;

use A2Insights\FilamentSaas\Settings\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class RestrictIps
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = App::make(Settings::class);

        if (in_array($request->ip(), $settings->restrict_ips)) {
            abort(403);
        }

        return $next($request);
    }
}
