<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetController;

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::view('/', 'index');

//Route vers la page index depuis adscontroller
Route::get('/', [adsController::class,'index'])->name('index');

//Route vers page détailszz ads
Route::get('/ads/{ad}', [adsController::class, 'detail'])->name('adsdetail');

Route::get('/dashboard', [adsController::class,'dashboard'])->name('ads.dashboard');

Route::get('/listeAds', [adsController::class,'show'])->name('ads.listeAds');

//route pour aller vers le formulaire de create Ads
Route::get('/create', [adsController::class, 'create'])->name('ads.createAd');

//route pour aller vers le controller de  create book
Route::post('/store', [adsController::class, 'store'])->name('ads.store');

//route pour appeler le formulaire de modification
Route::get('/edit/{ad}', [adsController::class, 'edit'])->name('ads.editAd');


//formulaire pour aller vers le controller pour update element
Route::put('/update/{ad}', [adsController::class, 'update'])->name('ads.update');

//formulaire pour aller vers le controller pour update element
Route::delete('/destroy/{ad}', [adsController::class, 'destroy'])->name('ads.destroy');


//register and login route

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Routes accessibles à tous les utilisateurs connectés
Route::middleware('auth')->group(function () {
    // L'utilisateur connecté peut voir et mettre à jour son profil
    Route::get('/profile', [UserController::class, 'show'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'update'])->name('user.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/change-password', [UserController::class, 'changeForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.post');


    // Routes accessibles uniquement à l'admin
    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}', [UserController::class, 'showUser'])->name('admin.users.show');
        Route::put('/users/{user}', [UserController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'deleteUser'])->name('admin.users.delete');
        Route::resource('categories', CategoryController::class);
    });
});


//Resset Password
Route::get('/password/reset', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
