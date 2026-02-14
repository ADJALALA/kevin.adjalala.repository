<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MagasinierMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Autoriser magasiniers ET admins
        if (!auth()->check() || (!auth()->user()->isMagasinier() && !auth()->user()->isAdmin())) {
            abort(403, 'Accès refusé. Réservé aux magasiniers.');
        }

        return $next($request);
    }
}