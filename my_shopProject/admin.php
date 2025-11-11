
<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$userObj = new User($pdo);
$productObj = new Product($pdo);
$categoryObj = new Category($pdo);

$totalUsers = count($userObj->getAllUsers());
$totalProducts = $productObj->getCount();
$totalCategories = count($categoryObj->getAll());
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - My Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="admin.php" class="text-2xl font-bold text-blue-600">Admin Panel</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="index.php" class="text-gray-700 hover:text-blue-600">Voir le site</a>
                    <span class="text-gray-700">Bonjour, <?= h($_SESSION['username']) ?></span>
                    <a href="logout.php" class="text-gray-700 hover:text-red-600">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
            <p class="text-gray-600 mt-2">Bienvenue dans l'interface d'administration</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500 text-sm">Utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $totalUsers ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500 text-sm">Produits</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $totalProducts ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500 text-sm">Catégories</p>
                        <p class="text-2xl font-bold text-gray-900"><?= $totalCategories ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Actions rapides</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Users Management -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des utilisateurs</h3>
                        <div class="space-y-3">
                            <a href="admin_users_list.php" 
                               class="block w-full text-left px-4 py-2 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition">
                                📋 Voir tous les utilisateurs
                            </a>
                            <a href="admin_user_edit.php" 
                               class="block w-full text-left px-4 py-2 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition">
                                ✏️ Modifier un utilisateur
                            </a>
                        </div>
                    </div>

                    <!-- Products Management -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des produits</h3>
                        <div class="space-y-3">
                            <a href="admin_product_add.php" 
                               class="block w-full text-left px-4 py-2 bg-green-50 text-green-700 rounded-md hover:bg-green-100 transition">
                                ➕ Ajouter un produit
                            </a>
                            <a href="admin_products_list.php" 
                               class="block w-full text-left px-4 py-2 bg-green-50 text-green-700 rounded-md hover:bg-green-100 transition">
                                📋 Voir tous les produits
                            </a>
                        </div>
                    </div>

                    <!-- Categories Management -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des catégories</h3>
                        <div class="space-y-3">
                            <a href="admin_category_add.php" 
                               class="block w-full text-left px-4 py-2 bg-purple-50 text-purple-700 rounded-md hover:bg-purple-100 transition">
                                ➕ Ajouter une catégorie
                            </a>
                            <a href="admin_categories_list.php" 
                               class="block w-full text-left px-4 py-2 bg-purple-50 text-purple-700 rounded-md hover:bg-purple-100 transition">
                                📋 Voir toutes les catégories
                            </a>
                        </div>
                    </div>

                    <!-- Site Management -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion du site</h3>
                        <div class="space-y-3">
                            <a href="index.php" 
                               class="block w-full text-left px-4 py-2 bg-gray-50 text-gray-700 rounded-md hover:bg-gray-100 transition">
                                👁️ Voir le site
                            </a>
                            <a href="search.php" 
                               class="block w-full text-left px-4 py-2 bg-gray-50 text-gray-700 rounded-md hover:bg-gray-100 transition">
                                🔍 Recherche de produits
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>