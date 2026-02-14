<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRI-HORIZONS SARL - Dépôt de Vente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-yellow-400 to-yellow-600 min-h-screen flex items-center justify-center">
    <div class="text-center text-white">
        <div class="bg-white w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl">
            <i class="fas fa-beer text-yellow-500 text-6xl"></i>
        </div>
        <span><h1 class="text-6xl font-bold mb-4"> TRI-HORISONS SARL</h1></span>
        
        <p class="text-2xl mb-8">Système de Gestion de Dépôt</p>
        
        <a href="{{ route('login') }}" class="bg-white text-yellow-600 px-8 py-4 rounded-lg text-xl font-bold hover:bg-yellow-100 transition shadow-lg">
            Se connecter
        </a>
        
        <p class="mt-8 text-sm opacity-80">© {{ date('Y') }} SOBEBRA - Tous droits réservés</p>
    </div>
</body>
</html>