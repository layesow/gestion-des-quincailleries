<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        $user = $request->user(); // Récupération de l'utilisateur connecté

        // Vérification du statut inactif
        if ($user->statut === 'inactif') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('info', 'Votre compte est actuellement inactif, veuillez patienter jusqu\'à la réactivation.');
            //return redirect()->route('page_inactif')->with('info', 'Votre profil est en attente de validation.');
        }

        if ($user->hasRole('admin|quincaillier') || $user->hasRole('gestionnaire')) {
            return redirect()->route('admin.index');
        } else {
            //return redirect()->route('dashboard');
            return redirect()->route('accueil');

        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
