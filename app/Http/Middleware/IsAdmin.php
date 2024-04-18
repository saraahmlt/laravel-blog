<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et s'il est un administrateur
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Si l'utilisateur est un administrateur, laisser passer la requête
            return $next($request);
        }

        // Si l'utilisateur n'est pas un administrateur, rediriger vers le tableau de bord avec un message d'erreur
        return redirect()->route('admin.dashboard')->with('error', 'Accès refusé. Seuls les administrateurs peuvent accéder à cette page.');
    }
}
