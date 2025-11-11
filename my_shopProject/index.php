<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'config.php';
require_once 'classes.php';

$pdo = getDbConnection();
$productObj = new Product($pdo);
$categoryObj = new Category($pdo);

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 12;
$offset = ($page - 1) * $perPage;

$products = $productObj->getAll($perPage, $offset);
$totalProducts = $productObj->getCount();
$totalPages = ceil($totalProducts / $perPage);

$categories = $categoryObj->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Shop - Boutique en ligne de qualité avec une large sélection de produits">
    <meta name="keywords" content="boutique, shop, produits, achats en ligne">
    <title>My Shop - Boutique en ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <a href="search.php" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </a>
                    
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

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Bienvenue sur My Shop</h1>
            <p class="text-xl md:text-2xl mb-8">Découvrez nos produits de qualité à des prix imbattables</p>
            <a href="search.php" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Rechercher des produits
            </a>
        </div>
    </div>

    <!-- Categories -->
    <?php if (!empty($categories)): ?>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Catégories</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php foreach (array_slice($categories, 0, 6) as $category): ?>
                <a href="search.php?category=<?= $category['id'] ?>" 
                   class="bg-white p-4 rounded-lg shadow hover:shadow-md transition text-center">
                    <div class="text-blue-600 text-3xl mb-2">📦</div>
                    <h3 class="font-semibold text-gray-900"><?= h($category['name']) ?></h3>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Nos produits</h2>
        
        <?php if (empty($products)): ?>
            <p class="text-center text-gray-600 py-12">Aucun produit disponible pour le moment.</p>
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
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="flex justify-center mt-12 space-x-2">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>" 
                           class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Précédent
                        </a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" 
                           class="px-4 py-2 <?= $i === $page ? 'bg-blue-600 text-white' : 'bg-white border border-gray-300 hover:bg-gray-50' ?> rounded-md">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?= $page + 1 ?>" 
                           class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Suivant
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 My Shop. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html