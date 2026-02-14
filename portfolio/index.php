<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Portfolio | Ebenior</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- SEO+ performance -->
  <meta name="description"
        content="Portfolio professionnel d’Ebenior, designer graphique et développeur web. Création de visuels et sites modernes.">
  <meta name="keywords"
        content="portfolio, designer graphique, développeur web, bénin">
  <meta name="author" content="Ebenior">
  <title>Portfolio Ebenior – Designer & Développeur web</title>

  <!-- Open Graph (réseaux sociaux) -->
  <meta property="og:title" content="Portfolio Ebenior">
  <meta property="og:description" content="Designer graphique & développeur web">
  <meta property="og:type" content="website">


  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- lien vers le fichier js -->
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
   <!-- liens vers boxicons -->

  <!-- Configuration couleurs -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#2563eb',
            secondary: '#1e40af'
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow fixed w-full z-50">
        <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">

            <!-- LOGO -->
             <div class="flex gap-2">
               <h1 class="text-xl font-bold text-gray-100 bg-gray-700 rounded-full px-2"><span>A</span></h1>
               <h1 class="text-xl font-bold text-gray-100 bg-gray-700 rounded-full px-2"><span>K</span></h1>
               <h1 class="text-xl font-bold text-gray-100 bg-gray-700 rounded-full px-2"><span>E</span></h1>
            </div>

            <!-- MENU DESKTOP -->
            <ul class="hidden md:flex gap-6">
            <li><a href="index.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Accueil</a></li>
            <li><a href="about.php" class="text-gray-700 hover:text-blue-600 font-medium transition">À propos</a></li>
            <li><a href="skills.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Compétences</a></li>
            <li><a href="projects.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Projets</a></li>
            <li><a href="contact.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a></li>
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
            <li><a href="index.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Accueil</a></li>
            <li><a href="about.php" class="text-gray-700 hover:text-blue-600 font-medium transition">À propos</a></li>
            <li><a href="skills.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Compétences</a></li>
            <li><a href="projects.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Projets</a></li>
            <li><a href="contact.php" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a></li>
            </ul>
        </div>
    </header>

    <!-- HERO -->
    <section class="reveal bg-gradient-to-r from-primary to-secondary text-white py-24">
      <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-4">
        Developpeur web & Designer graphique
        </h2>
        <p class="text-lg mb-8">
        Je crée des visuels modernes et des sites web clairs, rapides et professionnels.
        </p>
        <div class="flex justify-center gap-3">
          <a href="projects.php"
          class="bg-white hover:bg-gray-800 text-primary px-6 py-3 rounded-full font-semibold">
          Voir mes projets
          </a>
          <a href="contact.php"
          class="bg-red-500 hover:bg-red-600 text-gray-100 px-6 py-3 rounded-full font-semibold">
          Me contacter
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center py-24 text-sm text-gray-100 bg-gray-800">
    © 2026 – Portfolio Ebenior
    </footer>
    <script src="assets/js/main.js"></script>
</body>
</html>








