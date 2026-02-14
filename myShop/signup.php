<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-800">
    <div id="sign-up" class="max-w-md mx-auto p-8 bg-white shadow-lg backdrop-blur-lg bg-opacity-10 rounded-lg mt-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Creez un compte</h2>
        <form method="POST" action="#">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                <input type="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700  leading-tight focus:outline-none focus:shadow-outline" placeholder="entrez votre nom">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="votre_email@exemple.com">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                <input type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700  leading-tight focus:outline-none focus:shadow-outline" placeholder="Votre mot se passe">
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-purple-700 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-300">
                s'inscrire
                </button>
            </div>
            <p>
                Déjà un un compte ? 
                <a class="right-0 text-red-500 align-baseline text-sm font-bold text-500 hover:text-red-800" href="signin.php">se connecter</a>
            </p>
        </form>
    </div>
  </body>
</html>









<!-- Inscription -->
     