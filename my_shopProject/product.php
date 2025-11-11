<?php
require_once 'config.php';
require_once 'classes.php';

$pdo = getDbConnection();
$productObj = new Product($pdo);

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $productObj->getById($productId);

if (!$product) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= h(substr($product['description'], 0, 160)) ?>">
    <title><?= h($product['name']) ?> - My Shop</title>
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

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="index.php" class="text-blue-600 hover:text-blue-800">← Retour à la boutique</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <!-- Image -->
                <div class="bg-gray-100 rounded-lg flex items-center justify-center" style="min-height: 400px;">
                    <?php if ($product['image']): ?>
                        <img src="uploads/<?= h($product['image']) ?>" 
                             alt="<?= h($product['name']) ?>"
                             class="max-w-full max-h-[500px] object-contain">
                    <?php else: ?>
                        <span class="text-gray-400" style="font-size: 150px;">📦</span>
                    <?php endif; ?>
                </div>

                <!-- Details -->
                <div class="flex flex-col justify-between">
                    <div>
                        <?php if ($product['category_name']): ?>
                            <a href="search.php?category=<?= $product['category_id'] ?>" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-semibold">
                                <?= h($product['category_name']) ?>
                            </a>
                        <?php endif; ?>
                        
                        <h1 class="text-4xl font-bold text-gray-900 mt-2 mb-4">
                            <?= h($product['name']) ?>
                        </h1>

                        <div class="text-4xl font-bold text-blue-600 mb-6">
                            <?= number_format($product['price'], 2) ?> €
                        </div>

                        <div class="prose max-w-none mb-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">Description</h2>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                <?= h($product['description']) ?>
                            </p>
                        </div>

                        <?php if (isAdmin()): ?>
                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-800 font-semibold mb-2">Actions administrateur :</p>
                                <div class="flex space-x-2">
                                    <a href="admin_product_edit.php?id=<?= $product['id'] ?>" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Modifier ce produit
                                    </a>
                                    <a href="admin_products_list.php" 
                                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                                        Gérer les produits
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-8">
                        <button class="w-full bg-green-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                            Ajouter au panier (Fonctionnalité à venir)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <?php if ($product['category_id']): ?>
            <?php
            $relatedProducts = $productObj->search('', $product['category_id']);
            $relatedProducts = array_filter($relatedProducts, function($p) use ($productId) {
                return $p['id'] !== $productId;
            });
            $relatedProducts = array_slice($relatedProducts, 0, 4);
            ?>
            
            <?php if (!empty($relatedProducts)): ?>
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php foreach ($relatedProducts as $related): ?>
                            <a href="product.php?id=<?= $related['id'] ?>" 
                               class="bg-white rounded-lg shadow hover:shadow-xl transition">
                                <div class="h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                    <?php if ($related['image']): ?>
                                        <img src="uploads/<?= h($related['image']) ?>" 
                                             alt="<?= h($related['name']) ?>"
                                             class="h-full w-full object-cover rounded-t-lg">
                                    <?php else: ?>
                                        <span class="text-gray-400 text-5xl">📦</span>
                                    <?php endif; ?>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2"><?= h($related['name']) ?></h3>
                                    <p class="text-blue-600 font-bold"><?= number_format($related['price'], 2) ?> €</p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
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
</html>