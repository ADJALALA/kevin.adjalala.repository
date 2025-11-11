<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$userObj = new User($pdo);

// Gérer la suppression
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    if ($deleteId !== $_SESSION['user_id']) {
        $userObj->deleteUser($deleteId);
        header('Location: admin_users_list.php?deleted=1');
        exit;
    }
}

$users = $userObj->getAllUsers();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - Admin</title>
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
            <h1 class="text-3xl font-bold text-gray-900">Liste des utilisateurs</h1>
            <a href="admin.php" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                ← Retour
            </a>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                Utilisateur supprimé avec succès.
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $user['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?= h($user['username']) ?>
                                <?php if ($user['id'] === $_SESSION['user_id']): ?>
                                    <span class="ml-2 text-xs text-blue-600">(vous)</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= h($user['email']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if ($user['is_admin']): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Admin
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        User
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('d/m/Y', strtotime($user['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="admin_user_edit.php?id=<?= $user['id'] ?>" 
                                   class="text-blue-600 hover:text-blue-900">Modifier</a>
                                <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                    <a href="admin_users_list.php?delete=<?= $user['id'] ?>" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                       class="text-red-600 hover:text-red-900">Supprimer</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>