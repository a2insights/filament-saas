<?php

namespace A2insights\FilamentSaas\Tenant\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenancyInitialize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = Filament::getTenant();
        if ($company) {
            $company->initialize(); // @phpstan-ignore-line
        }

        return $next($request);
    }
}