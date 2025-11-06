<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|confirmed|min:6',
            'phone' => 'required|string|min:10',
        ]);

        $token = Str::random(64); // token unique pour la vérification
        //dd($token);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'phone'=> $request->phone,
            'verify_token'=> $token,
        ]);

        // Envoyer email de confirmation
        Mail::send('emails.verify', ['user'=>$user, 'token'=>$token], function($message) use ($user){
            $message->to($user->email);
            $message->subject('Confirm your email');
        });

        return redirect()->route('login')->with('success', 'Registration successful! Check your email to activate your account.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalide Token.');
        }

        $user->is_verified = true;
        $user->verify_token = null;
        $user->email_verified_at=now();
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified! You can now log in.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Incorrect email or password');
        }

        if (!$user->is_verified) {
            return back()->with('error', 'You must verify your email before logging in.');
        }

        // Connecter l'utilisateur
        Auth::login($user);

        return redirect()->route('ads.createAd')->with('success', 'Successfully connected');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
