<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Page d'accueil redirige vers login
 Route::get('/', function () {
     return view('welcome');
 });
// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect()->route('dashboard');
//     }
//     return view('welcome');
// });

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
    
    // Route::resource('produits', ProduitController::class);
    // Route::resource('ventes', VenteController::class);

    Route::middleware(['auth','admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
    // GESTION DES PRODUITS - Réservé aux Magasiniers et Admins
    Route::middleware(['magasinier'])->group(function () {
        Route::resource('produits', ProduitController::class);
    });
    
    // GESTION DES VENTES - Réservé aux Vendeurs et Admins
    Route::middleware(['vendeur'])->group(function () {
        Route::get('ventes/create', [VenteController::class, 'create'])->name('ventes.create');
        Route::post('ventes', [VenteController::class, 'store'])->name('ventes.store');
    });
    
    // HISTORIQUE VENTES - Accessible par tous (lecture seule)
    Route::get('ventes', [VenteController::class, 'index'])->name('ventes.index');
    Route::get('ventes/{vente}', [VenteController::class, 'show'])->name('ventes.show');
    
});

// require __DIR__.'/auth.php';


# 1. Créer les middlewares



# 2. Copier les codes ci-dessus

# 3. Vider le cache
