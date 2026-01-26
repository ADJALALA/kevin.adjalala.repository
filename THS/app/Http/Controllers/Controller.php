<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

# VUES BLADE - Interface Complète SOBEBRA

## 1. LAYOUT PRINCIPAL - resources/views/layouts/app.blade.php



## 2. DASHBOARD - resources/views/dashboard.blade.php



## 3. LISTE PRODUITS - resources/views/produits/index.blade.php



## 4. CRÉER/MODIFIER PRODUIT - resources/views/produits/create.blade.php



## 5. NOUVELLE VENTE - resources/views/ventes/create.blade.php



## 6. HISTORIQUE VENTES - resources/views/ventes/index.blade.php



## 7. DÉTAIL VENTE - resources/views/ventes/show.blade.php



## 8. COPIER LE FICHIER EDIT - resources/views/produits/edit.blade.php



## INSTRUCTIONS D'INSTALLATION COMPLÈTE

### 1. Créer les modèles manquants
### 2. Ajouter dans app/Models/Categorie.php
### 3. Ajouter dans app/Models/VenteDetail.php
### 4. Ajouter dans app/Models/MouvementStock.php
### 5. Modifier VenteController pour gérer le JSON
// Puis utiliser $produitsArray au lieu de $request->produits


# AUTHENTIFICATION PERSONNALISÉE SOBEBRA (SANS BREEZE)

## 1. CONTRÔLEUR - app/Http/Controllers/AuthController.php
## 2. ROUTES - routes/web.ph
## 3. VUE LOGIN - resources/views/auth/login.blade.php
## 4. VUE INSCRIPTION - resources/views/auth/register.blade.php (OPTIONNEL)
## 5. MODIFIER LE LAYOUT - resources/views/layouts/app.blade.php
# Remplacer la section déconnexion par :
## 6. MIDDLEWARE - Activer l'authentification par défaut

# Laravel a déjà le middleware 'auth' intégré
# Pas besoin de créer de fichier supplémentaire

## 7. COMMANDES À EXÉCUTER

# 1. Créer le contrôleur d'authentification


# 2. Créer les dossiers pour les vues

# 3. Créer les fichiers de vue
# Copier le code de login.blade.php et register.blade.php ci-dessus

# 4. Exécuter les migrations (crée la table users)
# 5. Créer l'utilisateur admin avec le seeder
# 6. Tester

## 8. TESTER L'AUTHENTIFICATION

# 1. Aller sur http://localhost:8000
# → Redirige vers /login

# 2. Se connecter avec :
# Email: admin@sobebra.com
# Mot de passe: password

# 3. Accès au dashboard
# → http://localhost:8000/dashboard

# 4. Tester la déconnexion
# → Clic sur bouton "Déconnexion"
# → Retour à /login

## 9. CRÉER UN UTILISATEUR MANUELLEMENT (si besoin)

// php artisan tinker

// >>> use App\Models\User;
// >>> use Illuminate\Support\Facades\Hash;
// >>> User::create([
// ...     'name' => 'Vendeur 1',
// ...     'email' => 'vendeur@sobebra.com',
// ...     'password' => Hash::make('password123')
// ... ]);

// ## AVANTAGES DE CETTE MÉTHODE

// ✅ Pas de dépendance externe (Breeze, Jetstream, etc.)
// ✅ Code 100% personnalisable
// ✅ Léger et rapide
// ✅ Facile à comprendre et modifier
// ✅ Contrôle total sur l'authentification
// ✅ Pas de fichiers inutiles

// ## SÉCURITÉ INCLUSE

// ✅ Hachage des mots de passe (bcrypt)
// ✅ Protection CSRF
// ✅ Régénération de session après login
// ✅ Validation des données
// ✅ Protection des routes sensibles
// ✅ Middleware d'authentification