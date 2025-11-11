<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$productObj = new Product($pdo);

// Gérer la suppression
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    $productObj->delete($deleteId);
    header('Location: admin_products_list.php?deleted=1');
    exit;
}

$products = $productObj->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Admin</title>
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
            <h1 class="text-3xl font-bold text-gray-900">Liste des produits</h1>
            <div class="space-x-2">
                <a href="admin_product_add.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    + Ajouter un produit
                </a>
                <a href="admin.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    ← Retour
                </a>
            </div>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Produit supprimé avec succès.
            </div>
        <?php endif; ?>

        <?php if (empty($products)): ?>
            <div class="bg-white shadow-md rounded-lg p-12 text-center">
                <p class="text-gray-600 text-lg">Aucun produit pour le moment.</p>
                <a href="admin_product_add.php" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                    Ajouter le premier produit
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <?php if ($product['image']): ?>
                                <img src="uploads/<?= h($product['image']) ?>" 
                                     alt="<?= h($product['name']) ?>"
                                     class="h-full w-full object-cover">
                            <?php else: ?>
                                <span class="text-gray-400 text-6xl">📦</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900"><?= h($product['name']) ?></h3>
                                <span class="text-lg font-bold text-blue-600"><?= number_format($product['price'], 2) ?> €</span>
                            </div>
                            <?php if ($product['category_name']): ?>
                                <p class="text-sm text-blue-600 mb-2">📁 <?= h($product['category_name']) ?></p>
                            <?php endif; ?>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                <?= h(substr($product['description'], 0, 100)) ?>...
                            </p>
                            <div class="flex space-x-2">
                                <a href="product.php?id=<?= $product['id'] ?>" 
                                   class="flex-1 text-center bg-gray-100 text-gray-700 px-3 py-2 rounded hover:bg-gray-200">
                                    Voir
                                </a>
                                <a href="admin_product_edit.php?id=<?= $product['id'] ?>" 
                                   class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded hover:bg-blue-200">
                                    Modifier
                                </a>
                                <a href="admin_products_list.php?delete=<?= $product['id'] ?>" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                   class="flex-1 text-center bg-red-100 text-red-700 px-3 py-2 rounded hover:bg-red-200">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>