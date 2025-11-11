<?php
require_once 'config.php';
require_once 'classes.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailOrUsername = trim($_POST['email_or_username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($emailOrUsername) || empty($password)) {
        $error = "Tous les champs sont requis.";
    } else {
        try {
            $pdo = getDbConnection();
            $userObj = new User($pdo);
            
            if ($userObj->login($emailOrUsername, $password)) {
                header('Location: admin.php');
                exit;
            } else {
                $error = "Email/nom d'utilisateur ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            $error = "Erreur de connexion : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - My Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Se connecter
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    <a href="signup.php" class="font-medium text-blue-600 hover:text-blue-500">
                        créez un nouveau compte
                    </a>
                </p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                <?= h($error) ?>
                            </h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <form class="mt-8 space-y-6" action="signin.php" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email_or_username" class="block text-sm font-medium text-gray-700">
                            Email ou nom d'utilisateur
                        </label>
                        <input id="email_or_username" name="email_or_username" type="text" required 
                               value="<?= h($_POST['email_or_username'] ?? '') ?>"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                               placeholder="exemple@email.com">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input id="password" name="password" type="password" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Se connecter
                    </button>
                </div>
            </form>
            
            <div class="text-center">
                <a href="index.php" class="text-sm text-gray-600 hover:text-gray-900">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>