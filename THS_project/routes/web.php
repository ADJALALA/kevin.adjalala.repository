<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Page d'accueil redirige vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes d'authentification (NON protégées)

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
     Route::resource('produCts', ProductController::class);
     Route::resource('ventes', VenteController::class);

     // Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
     // Route::post('/register', [AuthController::class, 'register']);
 });

//  require __DIR__.'/auth.php';



# 4. Exécuter les migrations et seeders
// php artisan migrate --seed

# 5. Créer le lien symbolique pour le stockage
// php artisan storage:link





// Route d'inscription (optionnel - à activer si besoin)



