<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SingleRouteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérez l'ID de l'URL
        $id = $request->route('id');

        // Vérifiez ici si la demande provient de l'URL spécifique autorisée
        if ($request->path() !== "immo/{$id}/show") {
            // Si la demande ne provient pas de l'URL spécifique, redirigez ou lancez une exception, selon votre logique
            return redirect()->route('index');
        }
        return $next($request);
    }
    }

