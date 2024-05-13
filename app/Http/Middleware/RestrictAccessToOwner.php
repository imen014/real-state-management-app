<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Immobilier;

class RestrictAccessToOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $immobilierId = $request->route('id'); // Assurez-vous d'adapter ceci selon votre route
        $immobilier = Immobilier::findOrFail($immobilierId);

        // Vérifier si l'utilisateur est connecté et s'il est le propriétaire de l'immobilier
        if (Auth::check() && Auth::user()->id === $immobilier->owner_id) {
            return $next($request);
        }

        // Si l'utilisateur n'est pas le propriétaire, rediriger ou renvoyer une réponse d'erreur
        return redirect('/')->with('error', 'Unauthorized access!');
    }
}
