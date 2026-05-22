<?php

namespace A2Insights\FilamentSaas\Tenant\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenancyInitialize
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = Filament::getTenant();
        if ($company) {
        }

        return $next($request);
    }
}
