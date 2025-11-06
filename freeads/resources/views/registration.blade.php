<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - FreeAds</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <style>
        .bg-auth {
            background-image: url('https://plus.unsplash.com/premium_photo-1684581214880-2043e5bc8b8b?w=400&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8YmxvZyUyMGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D');
            background-size: cover;
            background-position: center;
        }
    </style> -->
</head>

<body class="min-h-screen flex items-center justify-center bg-auth py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Créer un compte</h2>

        <!-- Affichage des erreurs générales -->
        @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <p class="font-semibold">Veuillez corriger les erreurs suivantes :</p>
            <ul class="list-disc list-inside mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Champ Nom -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none 
                              @error('name') border-red-500 @else border-gray-300 @enderror">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none
                              @error('email') border-red-500 @else border-gray-300 @enderror">
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Téléphone -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none
                              @error('phone_number') border-red-500 @else border-gray-300 @enderror">
                @error('phone_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Champ Mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none
                              @error('password') border-red-500 @else border-gray-300 @enderror">
                @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">S'inscrire</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">Connectez-vous ici</a>
            </p>
        </div>
    </div>
</body>

</html>