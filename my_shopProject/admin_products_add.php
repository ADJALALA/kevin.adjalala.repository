<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$productObj = new Product($pdo);
$categoryObj = new Category($pdo);

$errors = [];
$success = false;
$categories = $categoryObj->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $categoryId = $_POST['category_id'] ?? null;
    
    // Gérer l'upload de l'image
    $imageName = '';
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
            $productObj->create($name, $description, $price, $imageName, $categoryId);
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
    <title>Ajouter un produit - Admin</title>
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
            <h1 class="text-3xl font-bold text-gray-900">Ajouter un produit</h1>
            <a href="admin_products_list.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                ← Retour
            </a>
        </div>

        <?php if ($success): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Produit ajouté avec succès ! 
                <a href="admin_product_add.php" class="underline">Ajouter un autre produit</a>
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
            <form method="POST" enctype="multipart/form-data">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom du produit *</label>
                        <input type="text" name="name" value="<?= h($_POST['name'] ?? '') ?>" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= h($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prix (€) *</label>
                        <input type="number" name="price" step="0.01" min="0" value="<?= h($_POST['price'] ?? '') ?>" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select name="category_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Aucune catégorie</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                    <?= h($category['name']) ?>
                                    <?php if ($category['parent_name']): ?>
                                        (<?= h($category['parent_name']) ?>)
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image du produit</label>
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Formats acceptés : JPG, PNG, GIF</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Ajouter le produit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>