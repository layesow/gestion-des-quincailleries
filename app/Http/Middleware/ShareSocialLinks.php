<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareSocialLinks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer les liens sociaux depuis la base de données
        $socialLinks = SocialLink::all();

        // Partager les liens sociaux avec toutes les vues
        view()->share('socialLinks', $socialLinks);

        return $next($request);
    }
}
