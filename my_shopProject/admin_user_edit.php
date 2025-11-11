<?php
require_once 'config.php';
require_once 'classes.php';

requireAdmin();

$pdo = getDbConnection();
$userObj = new User($pdo);

$errors = [];
$success = false;
$user = null;

if (isset($_GET['id'])) {
    $userId = (int)$_GET['id'];
    $user = $userObj->getUserById($userId);
    
    if (!$user) {
        header('Location: admin_users_list.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;
    
    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis.";
    }
    
    if (empty($email) || !isValidEmail($email)) {
        $errors[] = "L'email est invalide.";
    }
    
    if (empty($errors)) {
        try {
            $userObj->updateUser($user['id'], $username, $email, $isAdmin);
            $success = true;
            $user = $userObj->getUserById($user['id']);
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
    <title>Modifier utilisateur - Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="admin.php" class="nav-logo">Admin Panel</a>
            <div class="nav-menu">
                <a href="admin.php" class="nav-link">Tableau de bord</a>
                <a href="logout.php" class="nav-link">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container py-8">
        <div class="page-header">
            <h1 class="dashboard-title">Modifier l'utilisateur</h1>
            <a href="admin_users_list.php" class="btn btn-gray">← Retour</a>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success">
                Utilisateur modifié avec succès !
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= h($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($user): ?>
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label class="form-label">Nom d'utilisateur</label>
                            <input type="text" name="username" value="<?= h($user['username']) ?>" 
                                   class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= h($user['email']) ?>" 
                                   class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="flex-center gap-2">
                                <input type="checkbox" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>>
                                <span>Droits administrateur</span>
                            </label>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary btn-block">
                                Modifier l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>