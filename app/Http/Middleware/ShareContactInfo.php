<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShareContactInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Définir les informations de contact
        $contactInfo = ContactInfo::all();

        // Partager les informations de contact avec toutes les vues
        view()->share('contactInfo', $contactInfo);

        return $next($request);
    }
}
