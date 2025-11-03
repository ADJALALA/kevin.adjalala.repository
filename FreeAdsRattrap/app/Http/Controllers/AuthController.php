<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use illuminate\Support\Str;

class AuthController extends Controller
{
    public function showSignup(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }
    public function showFormLogin(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // if(Auth::attempt($request->only('email', 'password'))){
        //     return redirect()->route('dashboard');
        // }
        // return back()->withErrors(['email' => 'Email or passwors wrong']);
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
    public function signup(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $token = Str::random(64); // token unique pour la vérification
        //dd($token);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verify_token'=> $token,
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));
        return back()->with('sucess', 'You have signed up sucessfully.');

        // Envoie automatique du mail de vérification
        // event(new Registered($user));

                // Envoyer email de confirmation
        // Mail::send('emails.verify', ['user'=>$user, 'token'=>$token], function($message) use ($user){
        //     $message->to($user->email);
        //     $message->subject('Confirm your email');
        // });

        // return redirect()->route('login')->with('success', 'Registration successful! Check your email to activate your account.');

        

        Auth::login($user);
        return redirect()->route('verification.notice');
    
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
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    
}
