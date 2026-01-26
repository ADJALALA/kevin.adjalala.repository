<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SOBEBRA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background-image: url('{{ asset('storage/bg2.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;" 
 class="bg-gradient-to-br from-yellow-400 to-yellow-600 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl p-8 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="bg-yellow-500 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-beer text-white text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">TRI-HORIZONS SARL</h1>
            <p class="text-gray-600">DISTRIBUTION</p>
        </div>

        <!-- Messages d'erreur -->
        @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2"></i>Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('email') border-red-500 @enderror">
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2"></i>Mot de passe
                </label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('password') border-red-500 @enderror">
            </div>

            <!-- Se souvenir de moi -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
            </div>

            <!-- Bouton de connexion -->
            <button type="submit" class="w-full bg-yellow-500 text-white py-3 rounded-lg hover:bg-yellow-600 font-semibold transition">
                <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
            </button>
        </form>

        <!-- Informations de test -->
        <div class="mt-6 p-4 bg-gray-50 rounded border border-gray-200">
            <p class="text-xs text-gray-600 font-semibold mb-2">
                <i class="fas fa-info-circle mr-1"></i>Compte de test :
            </p>
            <p class="text-xs text-gray-600">📧 admin@sobebra.com</p>
            <p class="text-xs text-gray-600">🔑 password</p>
        </div>

        <div class="mt-4 text-center text-xs text-gray-500">
            © {{ date('Y') }} SOBEBRA - Tous droits réservés
            <p class="text-xs text-gray-600">Abomey-Calavi -SIEGE Akassato</p>
        </div>
    </div>
</body>
</html>