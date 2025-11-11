<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$categoryObj = new Category($pdo);

// Gérer la suppression
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    try {
        $categoryObj->delete($deleteId);
        header('Location: admin_categories_list.php?deleted=1');
        exit;
    } catch (Exception $e) {
        $error = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

$categories = $categoryObj->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Admin</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Liste des catégories</h1>
            <div class="space-x-2">
                <a href="admin_category_add.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    + Ajouter une catégorie
                </a>
                <a href="admin.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    ← Retour
                </a>
            </div>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Catégorie supprimée avec succès.
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded">
                <?= h($error) ?>
            </div>
        <?php endif; ?>

        <?php if (empty($categories)): ?>
            <div class="bg-white shadow-md rounded-lg p-12 text-center">
                <p class="text-gray-600 text-lg">Aucune catégorie pour le moment.</p>
                <a href="admin_category_add.php" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                    Ajouter la première catégorie
                </a>
            </div>
        <?php else: ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie parente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $category['id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= h($category['name']) ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?= h(substr($category['description'] ?? '', 0, 50)) ?><?= strlen($category['description'] ?? '') > 50 ? '...' : '' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <?= $category['parent_name'] ? h($category['parent_name']) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="admin_category_edit.php?id=<?= $category['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-900">Modifier</a>
                                    <a href="admin_categories_list.php?delete=<?= $category['id'] ?>" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                       class="text-red-600 hover:text-red-900">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<
/body>
</html>