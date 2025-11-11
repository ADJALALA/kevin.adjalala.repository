<?php
require_once 'config.php';
require_once 'classes.php';

$pdo = getDbConnection();
$productObj = new Product($pdo);
$categoryObj = new Category($pdo);

// Récupérer les paramètres de recherche
$query = $_GET['q'] ?? '';
$categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
$minPrice = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? (float)$_GET['min_price'] : null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? (float)$_GET['max_price'] : null;
$sortBy = $_GET['sort'] ?? 'name';
$sortOrder = $_GET['order'] ?? 'ASC';

// Effectuer la recherche
$products = $productObj->search($query, $categoryId, $minPrice, $maxPrice, $sortBy, $sortOrder);
$categories = $categoryObj->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - My Shop</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-2xl font-bold text-blue-600">My Shop</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <?php if (isLoggedIn()): ?>
                        <span class="text-gray-700">Bonjour, <?= h($_SESSION['username']) ?></span>
                        <?php if (isAdmin()): ?>
                            <a href="admin.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Administration
                            </a>
                        <?php endif; ?>
                        <a href="logout.php" class="text-gray-700 hover:text-red-600">Déconnexion</a>
                    <?php else: ?>
                        <a href="signin.php" class="text-gray-700 hover:text-blue-600">Connexion</a>
                        <a href="signup.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <a href="index.php" class="text-blue-600 hover:text-blue-800">← Retour à l'accueil</a>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Recherche de produits</h1>

        <!-- Search Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form method="GET" action="search.php" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                        <input type="text" name="q" value="<?= h($query) ?>" placeholder="Nom du produit..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Toutes les catégories</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= $categoryId == $category['id'] ? 'selected' : '' ?>>
                                    <?= h($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix min (€)</label>
                        <input type="number" name="min_price" step="0.01" min="0" value="<?= $minPrice !== null ? h($minPrice) : '' ?>" placeholder="0.00"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix max (€)</label>
                        <input type="number" name="max_price" step="0.01" min="0" value="<?= $maxPrice !== null ? h($maxPrice) : '' ?>" placeholder="1000.00"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trier par</label>
                        <select name="sort"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="name" <?= $sortBy === 'name' ? 'selected' : '' ?>>Nom</option>
                            <option value="price" <?= $sortBy === 'price' ? 'selected' : '' ?>>Prix</option>
                            <option value="created_at" <?= $sortBy === 'created_at' ? 'selected' : '' ?>>Date d'ajout</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ordre</label>
                        <select name="order"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="ASC" <?= $sortOrder === 'ASC' ? 'selected' : '' ?>>Croissant</option>
                            <option value="DESC" <?= $sortOrder === 'DESC' ? 'selected' : '' ?>>Décroissant</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            🔍 Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results -->
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-900">
                <?= count($products) ?> résultat<?= count($products) > 1 ? 's' : '' ?> trouvé<?= count($products) > 1 ? 's' : '' ?>
            </h2>
        </div>

        <?php if (empty($products)): ?>
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-xl text-gray-600">Aucun produit ne correspond à votre recherche.</p>
                <a href="search.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Réinitialiser la recherche</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <a href="product.php?id=<?= $product['id'] ?>">
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
                                <?php if ($product['category_name']): ?>
                                    <span class="text-xs text-blue-600 font-semibold"><?= h($product['category_name']) ?></span>
                                <?php endif; ?>
                                <h3 class="text-lg font-semibold text-gray-900 mt-1 mb-2">
                                    <?= h($product['name']) ?>
                                </h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    <?= h(substr($product['description'], 0, 100)) ?>...
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-blue-600">
                                        <?= number_format($product['price'], 2) ?> €
                                    </span>
                                    <span class="text-blue-600 hover:text-blue-800">Voir →</span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 My Shop. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>