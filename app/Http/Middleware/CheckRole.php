<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // Rediriger l'utilisateur s'il n'est pas connecté
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Vérifier si l'utilisateur a l'un des rôles autorisés
        foreach ($roles as $role) {
            if ($user->role !== $role) {
                // Rediriger l'utilisateur s'il a un rôle interdit
                return redirect('/');
            }
        }

        return $next($request);
    }
}
