<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', function ($attribute, $value, $fail) {
                if (!User::where('email', $value)->exists()) {
                    $fail('Nous ne trouvons pas d\'utilisateur avec cette adresse e-mail.');
                }
            }],
        ],[
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
        ? back()->with('status', 'Le lien de réinitialisation de mot de passe a été envoyé avec succès.')
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => 'Une erreur s\'est produite lors de l\'envoi du lien de réinitialisation. Veuillez réessayer.']);
    }
}
