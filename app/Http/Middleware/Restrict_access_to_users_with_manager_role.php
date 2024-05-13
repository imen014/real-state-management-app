<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Restrict_access_to_users_with_manager_role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       
        // Vérifier si l'utilisateur est connecté et s'il est le propriétaire de l'immobilier
        if (Auth::check() && Auth::user()->role === "Manager") {
            return $next($request);
        }

        // Si l'utilisateur n'est pas le propriétaire, rediriger ou renvoyer une réponse d'erreur
        return redirect('/')->with('error', 'Unauthorized access!');
    }
}
