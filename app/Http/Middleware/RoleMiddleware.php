<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('rdm.login')
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Vous devez être connecté pour accéder à cette page.'
                ]);
        }

        $user = Auth::user();

        // Vérifie si l'utilisateur a au moins un des rôles attendus
        if (!$user->hasRole($roles)) {
            abort(403, 'Accès refusé. vous n\'êtes pas administrateur.');
        }

        return $next($request);
    }
}
