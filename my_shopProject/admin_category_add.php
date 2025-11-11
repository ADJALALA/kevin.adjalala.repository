<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$categoryObj = new Category($pdo);

$errors = [];
$success = false;
$categories = $categoryObj->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $parentId = $_POST['parent_id'] ?? null;
    
    // Validation
    if (empty($name)) {
        $errors[] = "Le nom de la catégorie est requis.";
    }
    
    if (empty($errors)) {
        try {
            $categoryObj->create($name, $description, $parentId);
            $success = true;
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="admin.php" class="text-2xl font-bold text-blue-600">Admin Panel</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="admin.php" class="text-gray-700 hover:text-blue-600">Tableau de bord</a>
                    <a href="logout.php" class="text-gray-700 hover:text-red-600">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Ajouter une catégorie</h1>
            <a href="admin_categories_list.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                ← Retour
            </a>
        </div>

        <?php if ($success): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Catégorie ajoutée avec succès ! 
                <a href="admin_category_add.php" class="underline">Ajouter une autre catégorie</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $error): ?>
                        <li><?= h($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom de la catégorie *</label>
                        <input type="text" name="name" value="<?= h($_POST['name'] ?? '') ?>" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= h($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie parente</label>
                        <select name="parent_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Aucune (catégorie racine)</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($_POST['parent_id']) && $_POST['parent_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= h($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Sélectionner une catégorie parente pour créer une sous-catégorie</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Ajouter la catégorie
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Exemple de hiérarchie -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">💡 Exemple de hiérarchie</h3>
            <div class="text-sm text-blue-800 space-y-1">
                <p>📁 Meubles (catégorie racine)</p>
                <p class="ml-4">📁 Chaises (sous-catégorie de Meubles)</p>
                <p class="ml-8">📁 Chaises en bois (sous-catégorie de Chaises)</p>
                <p class="ml-8">📁 Chaises en plastique (sous-catégorie de Chaises)</p>
            </div>
        </div>
    </div>
</body>
</html>