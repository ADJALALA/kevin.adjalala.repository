<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body>
    <header class="bg-gray-800  w-full z-50">
        <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <!-- LOGO -->
            <h1 class="text-xl font-bold text-primary">Ebenior</h1>

            <!-- MENU DESKTOP -->
            <ul class="hidden md:flex gap-6">
            <li><a href="index.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Accueil</a></li>
            <li><a href="about.php" class="text-gray-100 hover:text-blue-600 font-medium transition">À propos</a></li>
            <li><a href="skills.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Compétences</a></li>
            <li><a href="projects.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Projets</a></li>
            <li><a href="contact.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Contact</a></li>
            </ul>

            <!-- BOUTON MOBILE -->
            <button id="menuBtn" class="md:hidden">
            ☰
            </button>
        </nav>

        <!-- MENU MOBILE -->
        <div id="mobileMenu"
            class="hidden md:hidden bg-white border-t">
            <ul class="flex flex-col p-4 gap-4">
            <li><a href="index.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Accueil</a></li>
            <li><a href="about.php" class="text-gray-100 hover:text-blue-600 font-medium transition">À propos</a></li>
            <li><a href="skills.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Compétences</a></li>
            <li><a href="projects.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Projets</a></li>
            <li><a href="contact.php" class="text-gray-100 hover:text-blue-600 font-medium transition">Contact</a></li>
            </ul>
        </div>
    </header>
    <section class="max-w-6xl mx-auto p-8">
      <h2 class="text-3xl font-bold mb-8 text-primary">Projets</h2>

      <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded shadow overflow-hidden transform hover:translate-y-5 transition duration-300">
          <img src="assets/images/WhatsApp Image 2026-01-11 at 21.07.46.jpeg" alt="Projet 1">
          <div class="p-4">
            <h3 class="font-semibold">Un Flyer</h3>
            <p class="text-sm text-gray-600">Réaliser avec <b>Canva</b> pour une entreprise a l'occasion du nouvel an</p>
          </div>
        </div>

        <div class="bg-white rounded shadow overflow-hidden transform hover:translate-y-5 transition duration-300">
          <img src="assets/images/jpeg(18)" alt="Projet 2" class="object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Affiche publicitaire</h3>
            <p class="text-sm text-gray-600">Réaliser avec une application mobile <b>Pixellab</b> juste avec un téléphone portable</p>
          </div>
        </div>
        <div class="bg-white rounded shadow overflow-hidden transform hover:translate-y-5 transition duration-300">
          <img src="assets/images/jpeg(19)" alt="Projet 2" class="object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Affiche/Fluer</h3>
            <p class="text-sm text-gray-600">Réaliser avec une application mobile <b>Pixellab</b></p>
          </div>
        </div>
        <div class="bg-white rounded shadow overflow-hidden transform hover:translate-y-5 transition duration-300">
          <img src="assets/images/Art & design graphique.jpeg" alt="Projet 2" class="object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Affiche publicitaire</h3>
            <p class="text-sm text-gray-600">Réaliser avec <b>Pixellab</b></p>
          </div>
        </div>
        <div class="bg-white rounded shadow overflow-hidden transform hover:translate-y-5 transition duration-300">
          <img src="assets/images/Du atchiékê zôzô.jpeg" alt="Projet 2" class="object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Affiche publicitaire</h3>
            <p class="text-sm text-gray-600">Réaliser avec l'app <b>Pixellab</b> pour la promotion d'un produit alimentaire</p>
          </div>
        </div>

      </div>
    </section>
  </body>
</html>



