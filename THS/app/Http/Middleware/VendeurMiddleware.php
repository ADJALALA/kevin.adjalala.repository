<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendeurMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Autoriser seulement les vendeurs ET les admins
        if (!auth()->check() || (!auth()->user()->isVendeur() && !auth()->user()->isAdmin())) {
            abort(403, 'Accès refusé. Réservé aux vendeurs.');
        }

        return $next($request);
    }
}