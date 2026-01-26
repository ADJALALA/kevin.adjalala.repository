<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

// Page d'accueil redirige vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes d'authentification (NON protégées)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            // Route d'inscription (optionnel - à activer si besoin)
        // Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        // Route::post('/register', [AuthController::class, 'register']);
    
    Route::resource('produits', ProduitController::class);
    Route::resource('ventes', VenteController::class);
});

// require __DIR__.'/auth.php';



# 5. Créer le lien symbolique pour le stockage
// php artisan storage:link
