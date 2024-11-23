<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgenceStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->agence && in_array($user->agence->statut, ['inactif', 'en traitement'])) {
            // Déconnexion de l'utilisateur et redirection vers la page de connexion
            auth()->logout();
            return redirect()->route('login')->with('error', 'Votre agence est inactive ou en cours de traitement. Veuillez attendre la validation de votre compte et réessayer plus tard.');
        }

        return $next($request);
    }
}
