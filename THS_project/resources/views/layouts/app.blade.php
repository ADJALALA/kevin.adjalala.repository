<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SOBEBRA Dépôt')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-lg">
                        <i class="fas fa-beer text-yellow-500 text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">SOBEBRA</h1>
                        <p class="text-yellow-100 text-sm">Dépôt de Vente</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-yellow-700 hover:bg-yellow-800 px-4 py-2 rounded text-sm">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-6">
            <div class="flex space-x-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-6 py-4 font-medium transition {{ request()->routeIs('dashboard') ? 'text-yellow-600 border-b-2 border-yellow-600' : 'text-gray-600 hover:text-yellow-600' }}">
                    <i class="fas fa-chart-line"></i>
                    Tableau de Bord
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 px-6 py-4 font-medium transition {{ request()->routeIs('products.*') ? 'text-yellow-600 border-b-2 border-yellow-600' : 'text-gray-600 hover:text-yellow-600' }}">
                    <i class="fas fa-box"></i>
                    Produits
                </a>
                <a href="{{ route('ventes.create') }}" class="flex items-center gap-2 px-6 py-4 font-medium transition {{ request()->routeIs('ventes.create') ? 'text-yellow-600 border-b-2 border-yellow-600' : 'text-gray-600 hover:text-yellow-600' }}">
                    <i class="fas fa-cash-register"></i>
                    Nouvelle Vente
                </a>
                <a href="{{ route('ventes.index') }}" class="flex items-center gap-2 px-6 py-4 font-medium transition {{ request()->routeIs('ventes.index') || request()->routeIs('ventes.show') ? 'text-yellow-600 border-b-2 border-yellow-600' : 'text-gray-600 hover:text-yellow-600' }}">
                    <i class="fas fa-history"></i>
                    Historique Ventes
                </a>
            </div>
        </div>
    </nav>

    <!-- Messages Flash -->
    @if(session('success'))
    <div class="container mx-auto px-6 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mx-auto px-6 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Contenu Principal -->
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>