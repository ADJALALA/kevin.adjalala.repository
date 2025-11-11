<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$productObj = new Product($pdo);
$categoryObj = new Category($pdo);

$errors = [];
$success = false;
$product = null;
$categories = $categoryObj->getAll();

if (isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    $product = $productObj->getById($productId);
    
    if (!$product) {
        header('Location: admin_products_list.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $categoryId = $_POST['category_id'] ?? null;
    
    // Gérer l'upload de la nouvelle image
    $imageName = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $imageName = uniqid() . '.' . $ext;
            $uploadPath = 'uploads/' . $imageName;
            
            if (!is_dir('uploads')) {
                mkdir('uploads', 0755, true);
            }
            
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            
            // Supprimer l'ancienne image si elle existe
            if ($product['image'] && file_exists('uploads/' . $product['image'])) {
                unlink('uploads/' . $product['image']);
            }
        } else {
            $errors[] = "Format d'image non autorisé.";
        }
    }
    
    // Validation
    if (empty($name)) {
        $errors[] = "Le nom du produit est requis.";
    }
    
    if (empty($price) || !is_numeric($price) || $price < 0) {
        $errors[] = "Le prix doit être un nombre positif.";
    }
    
    if (empty($errors)) {
        try {
            $productObj->update($product['id'], $name, $description, $price, $imageName, $categoryId);
            $success = true;
            $product = $productObj->getById($product['id']);
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
    <title>Modifier un produit - Admin</title>
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
            <h1 class="text-3xl font-bold text-gray-900">Modifier le produit</h1>
            <a href="admin_products_list.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                ← Retour
            </a>
        </div>

        <?php if ($success): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Produit modifié avec succès !
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

        <?php if ($product): ?>
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" enctype="multipart/form-data">
                    <div class="space-y-4">
                        <?php if ($product['image']): ?>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                                <img src="uploads/<?= h($product['image']) ?>" alt="<?= h($product['name']) ?>" 
                                     class="h-32 w-32 object-cover rounded border border-gray-300">
                            </div>
                        <?php endif; ?>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nom du produit *</label>
                            <input type="text" name="name" value="<?= h($product['name']) ?>" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= h($product['description']) ?></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prix (€) *</label>
                            <input type="number" name="price" step="0.01" min="0" value="<?= h($product['price']) ?>" required
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="category_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Aucune catégorie</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                        <?= h($category['name']) ?>
                                        <?php if ($category['parent_name']): ?>
                                            (<?= h($category['parent_name']) ?>)
                                        <?php endif; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nouvelle image</label>
                            <input type="file" name="image" accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-1 text-sm text-gray-500">Laisser vide pour conserver l'image actuelle</p>
                        </div>

                        <div class="pt-4 flex space-x-2">
                            <button type="submit"
                                    class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Enregistrer les modifications
                            </button>
                            <a href="product.php?id=<?= $product['id'] ?>" 
                               class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                                Voir le produit
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>