<?php
$error = "";
$sucess = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['number']) ||
    empty($_POST['message'])
  ) {
    header("Location: contact.php?error=1");
    exit;
  }

  $to = "tonemail@gmail.com";
  $subject = "Message Portfolio";
  $message = htmlspecialchars($_POST['message']);
  $headers = "From: " . $_POST['email'];

  mail($to, $subject, $message, $headers);
  header("Location: contact.php?success=1");
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-800 shadow">
    <header class="bg-white shadow  w-full z-50">
        <nav class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <!-- LOGO -->
            <h1 class="text-xl font-bold text-primary">Ebenior</h1>

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
    
      <div class="max-w-6xl mx-auto p-8 mt-20 bg-white shadow rounded-lg m-5">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Voulez-vous envoyez un message ?</h2>
        <form method="POST" action="#" class="space-y-4">
          <input type="text" name="name" placeholder="entrer votre nom" class="w-full border p-2" required>
          <input type="email" name="email"  placeholder=" votre adresse email" class="w-full border p-2" required>
          <input type="number" name="number"  placeholder=" votre numero de telephone" class="w-full border p-2" required>
          <textarea name="message" placeholder=" entrer votre Message" class="w-full border p-2"></textarea>
          <div class="flex gap-3">
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
              Envoyer
            </button>
            <a href="index.php" class=" underline text-gray-800 hover:text-blue-700 text-sm">
              Retour vers la page d'Accueil
            </a>
          </div>
        </form>
      </div>
  </body>
</html>


