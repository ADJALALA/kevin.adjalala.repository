
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
            <div class="flex gap-2">
              <h1 class="text-xl font-bold text-gray-800 bg-white rounded-full px-2"><span>A</span></h1>
              <h1 class="text-xl font-bold text-gray-800 bg-white rounded-full px-2"><span>K</span></h1>
              <h1 class="text-xl font-bold text-gray-800 bg-white rounded-full px-2"><span>E</span></h1>
            </div>

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
    <div class="max-w-6xj mx-auto py-2 bg-gradient-to-r from-blue-400 via purple-500 to-pink-500"></div>
    <section class="max-w-4xl mx-auto p-8">
        <h2 class="text-3xl font-bold mb-4 text-primary">À propos</h2>
        <p><b>Kévin Ebénior ADJALALA,</b> <span style="color: blue;">Developpeur web fullstack, web designer</span></p>
        <p class="mb-4">
            
            Je suis passionné par la conception des solutions numeriques innovantes et souveraines.
            J’aide les particuliers et les entreprises à valoriser leur image
            à travers des visuels et des sites modernes.
        </p>

        <p>
            Je me forme continuellement pour offrir des solutions simples,
            efficaces et adaptées aux besoins réels.
        </p>
   </section>  
  </body>
</html>

