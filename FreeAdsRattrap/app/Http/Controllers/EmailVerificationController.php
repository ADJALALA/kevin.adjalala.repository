<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;


class EmailVerificationController extends Controller
{
    // Page d’attente de vérification
    public function notice()
    {
        return view('auth.verify-email');
    }

    // Quand l’utilisateur clique sur le lien de vérification
    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard')->with('info', 'Email déjà vérifié.');
        }

        $request->fulfill(); // marque l’email comme vérifié

        return redirect()->route('dashboard')->with('success', 'Email vérifié avec succès !');
    }

    // Renvoyer un nouveau mail de vérification
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Nouveau lien envoyé à votre email.');
    }

}
