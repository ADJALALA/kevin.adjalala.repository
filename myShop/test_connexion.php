<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 Test de connexion à la base de données</h2>";

// Test 1 : Vérifier les constantes
echo "<h3>1️⃣ Vérification des constantes</h3>";
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'myShop');
define('DB_USER', 'root');
define('DB_PASS', '');

echo "Host: " . DB_HOST . "<br>";
echo "Database: " . DB_NAME . "<br>";
echo "User: " . DB_USER . "<br>";
echo "Pass: " . (empty(DB_PASS) ? '(vide)' : '***') . "<br><br>";

// Test 2 : Tentative de connexion
echo "<h3>2️⃣ Tentative de connexion PDO</h3>";
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    
    echo "✅ <strong style='color: green;'>Connexion réussie !</strong><br><br>";
    
    // Test 3 : Vérifier la table 'product'
    echo "<h3>3️⃣ Vérification de la table 'product'</h3>";
    
    $stmt = $pdo->query("SHOW TABLES LIKE 'product'");
    if ($stmt->rowCount() > 0) {
        echo "✅ La table 'product' existe<br><br>";
        
        // Test 4 : Voir la structure de la table
        echo "<h3>4️⃣ Structure de la table</h3>";
        $stmt = $pdo->query("DESCRIBE product");
        $columns = $stmt->fetchAll();
        
        echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
        echo "<tr><th>Colonne</th><th>Type</th><th>Null</th><th>Clé</th></tr>";
        foreach ($columns as $col) {
            echo "<tr>";
            echo "<td>" . $col['Field'] . "</td>";
            echo "<td>" . $col['Type'] . "</td>";
            echo "<td>" . $col['Null'] . "</td>";
            echo "<td>" . $col['Key'] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
        
        // Test 5 : Compter les produits
        echo "<h3>5️⃣ Nombre de produits dans la table</h3>";
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM product");
        $result = $stmt->fetch();
        echo "Total de produits : <strong>" . $result['total'] . "</strong><br><br>";
        
        // Test 6 : Afficher les produits
        if ($result['total'] > 0) {
            echo "<h3>6️⃣ Liste des produits</h3>";
            $stmt = $pdo->query("SELECT * FROM product");
            $products = $stmt->fetchAll();
            
            echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
            echo "<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Image</th><th>Description</th></tr>";
            foreach ($products as $prod) {
                echo "<tr>";
                echo "<td>" . ($prod['id'] ?? 'N/A') . "</td>";
                echo "<td>" . ($prod['name'] ?? 'N/A') . "</td>";
                echo "<td>" . ($prod['price'] ?? 'N/A') . "€</td>";
                echo "<td>" . ($prod['image'] ?? 'N/A') . "</td>";
                echo "<td>" . (substr($prod['description'] ?? 'N/A', 0, 50)) . "...</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } else {
        echo "❌ <strong style='color: red;'>La table 'product' n'existe pas !</strong><br>";
        echo "Vous devez créer la table avec cette commande SQL :<br><br>";
        echo "<pre style='background: #f4f4f4; padding: 10px; border-radius: 5px;'>";
        echo "CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255),
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
        echo "</pre>";
    }
    
} catch (PDOException $e) {
    echo "❌ <strong style='color: red;'>Erreur de connexion !</strong><br>";
    echo "Message : " . $e->getMessage() . "<br>";
    echo "Code : " . $e->getCode() . "<br><br>";
    
    echo "<h3>🔧 Solutions possibles :</h3>";
    echo "<ul>";
    echo "<li>Vérifiez que MySQL/MariaDB est démarré</li>";
    echo "<li>Vérifiez que la base de données 'myShop' existe</li>";
    echo "<li>Vérifiez vos identifiants (user: root, pass: vide)</li>";
    echo "<li>Essayez 'localhost' au lieu de '127.0.0.1'</li>";
    echo "</ul>";
}
?>