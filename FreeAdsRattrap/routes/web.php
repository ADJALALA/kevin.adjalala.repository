<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

Route::get('/', function () {
    return view('welcome');
});
//auth
Route::get('/register', [AuthController::class,'showSignup'])->name('register');
Route::post('/register', [AuthController::class,'SignUp'])->name('registration.register');

Route::get('/login', [AuthController::class,'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.submit');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Page protégée
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Vérification email
Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Lien de vérification envoyé !');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

