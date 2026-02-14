<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../config.php/commands.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ✅ Vérification admin (à décommenter quand vous aurez le système d'auth)
// if (!isset($_SESSION['user_id']) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
//     header('Location: signin.php');
//     exit;
// }

// Pour le test, on simule un admin connecté
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'Admin';
    $_SESSION['user_id'] = 1;
}

$action = $_GET['action'] ?? 'dashboard';
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

$success = false;
$errors = [];

// ✅ Récupération des produits pour l'affichage
$products = displayProducts();

// ==============================================
// TRAITEMENT DES FORMULAIRES (POST)
// ==============================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // AJOUT D'UN PRODUIT
    if ($action === 'add_product') {
        $picture = trim($_POST['picture'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        
        if (empty($name)) {
            $errors[] = "Le nom du produit est requis.";
        }
        
        if ($price <= 0) {
            $errors[] = "Le prix doit être supérieur à 0.";
        }
        
        if (empty($picture)) {
            $errors[] = "L'image du produit est requise.";
        }
        
        if (empty($errors)) {
            try {
                addProducts($picture, $name, $price, $description);
                $success = "Produit ajouté avec succès !";
                // Recharger les produits
                $products = displayProducts();
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
    }
    
    // MODIFICATION D'UN PRODUIT
    if ($action === 'edit_product') {
        $picture = trim($_POST['picture'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        
        if (empty($name)) {
            $errors[] = "Le nom du produit est requis.";
        }
        
        if ($price <= 0) {
            $errors[] = "Le prix doit être supérieur à 0.";
        }
        
        if (empty($picture)) {
            $errors[] = "L'image du produit est requise.";
        }
        
        if (empty($errors) && !empty($id)) {
            try {
                updateProduct($id, $picture, $name, $price, $description);
                $success = "Produit modifié avec succès !";
                // Recharger les produits
                $products = displayProducts();
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
    }
}

// ==============================================
// SUPPRESSION D'ÉLÉMENTS (GET)
// ==============================================

if ($action === 'delete' && !empty($id)) {
    if ($type === 'product') {
        try {
            deleteProducts($id);
            $success = "Produit supprimé avec succès !";
            // Recharger les produits
            $products = displayProducts();
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
}

// ==============================================
// RÉCUPÉRATION D'UN PRODUIT POUR ÉDITION
// ==============================================

$edit_product = null;
if ($action === 'edit' && $type === 'product' && !empty($id)) {
    try {
        $edit_product = getProductById($id);
    } catch (Exception $e) {
        $errors[] = "Produit non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Ma Boutique</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- HEADER DE L'INTERFACE ADMIN -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">ADMINISTRATION</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Bonjour, <?= htmlspecialchars($_SESSION['username']) ?>
                    </span>
                    <a href="../index.php" class="text-sm text-blue-600 hover:text-blue-800">
                        Voir la boutique
                    </a>
                    <a href="logout.php" class="text-sm text-red-600 hover:text-red-800">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- AFFICHAGE DES MESSAGES -->
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- NAVIGATION DE L'ADMIN -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4">
                <nav class="flex space-x-8">
                    <a href="?action=dashboard" 
                       class="<?= $action === 'dashboard' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' ?> pb-2">
                        Dashboard
                    </a>
                    <a href="?action=products" 
                       class="<?= $action === 'products' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' ?> pb-2">
                        Produits
                    </a>
                </nav>
            </div>
        </div>

        <!-- CONTENU SELON L'ACTION SÉLECTIONNÉE -->

        <?php if ($action === 'dashboard'): ?>
            <!-- PAGE D'ACCUEIL ADMIN AVEC STATISTIQUES -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Produits</h3>
                    <p class="text-3xl font-bold text-green-600"><?= count($products) ?></p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Revenu Total</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        <?php
                        $total = 0;
                        foreach ($products as $p) {
                            $total += $p->price;
                        }
                        echo number_format($total, 2);
                        ?>€
                    </p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Actions</h3>
                    <a href="?action=products" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                        Gérer les produits
                    </a>
                </div>
            </div>

            <!-- DERNIERS PRODUITS AJOUTÉS -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Derniers produits ajoutés</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php 
                    $last_products = array_slice($products, 0, 5);
                    foreach ($last_products as $product): 
                    ?>
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <?php if (!empty($product->picture)): ?>
                                    <img src="../<?= htmlspecialchars($product->picture) ?>" 
                                         alt="<?= htmlspecialchars($product->name) ?>"
                                         class="w-12 h-12 object-cover rounded mr-4">
                                <?php endif; ?>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($product->name) ?>
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        <?= number_format($product->price, 2) ?>€
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($action === 'products'): ?>
            <!-- GESTION DES PRODUITS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- FORMULAIRE D'AJOUT/ÉDITION DE PRODUIT -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <?= $edit_product ? 'Modifier le produit' : 'Ajouter un produit' ?>
                    </h3>
                    
                    <form method="POST" action="?action=<?= $edit_product ? 'edit_product&id=' . $edit_product->id : 'add_product' ?>">
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom du produit *</label>
                            <input type="text" name="name" required 
                                   value="<?= $edit_product ? htmlspecialchars($edit_product->name) : '' ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"><?= $edit_product ? htmlspecialchars($edit_product->description) : '' ?></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prix (€) *</label>
                            <input type="number" name="price" required min="0" step="0.01"
                                   value="<?= $edit_product ? $edit_product->price : '' ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Chemin de l'image *</label>
                            <input type="text" name="picture" required 
                                   value="<?= $edit_product ? htmlspecialchars($edit_product->picture) : '' ?>"
                                   placeholder="images/produit.jpg"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Exemple : images/smartphone.jpg</p>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                            <?= $edit_product ? 'Modifier' : 'Ajouter' ?>
                        </button>
                        
                        <?php if ($edit_product): ?>
                            <a href="?action=products" class="block w-full text-center mt-2 bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 transition-colors">
                                Annuler
                            </a>
                        <?php endif; ?>
                    </form>
                </div>
                
                <!-- LISTE DES PRODUITS EXISTANTS -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Liste des produits (<?= count($products) ?>)</h3>
                    </div>
                    <div class="divide-y divide-gray-200 max-h-[600px] overflow-y-auto">
                        <?php foreach ($products as $product): ?>
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <?php if (!empty($product->picture)): ?>
                                        <img src="../<?= htmlspecialchars($product->picture) ?>" 
                                             alt="<?= htmlspecialchars($product->name) ?>"
                                             class="w-12 h-12 object-cover rounded mr-4">
                                    <?php endif; ?>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">
                                            <?= htmlspecialchars($product->name) ?>
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            <?= number_format($product->price, 2) ?>€
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="?action=edit&type=product&id=<?= $product->id ?>" 
                                       class="text-blue-600 hover:text-blue-800 text-sm">Modifier</a>
                                    <a href="?action=delete&type=product&id=<?= $product->id ?>" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                       class="text-red-600 hover:text-red-800 text-sm">Supprimer</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <?php if (empty($products)): ?>
                            <div class="px-6 py-4 text-center text-gray-500">Aucun produit trouvé</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

</body>
</html>