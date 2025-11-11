<?php
// classes.php - Classes orientées objet

class User {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function register($username, $email, $password) {
        // Vérifier si l'email existe déjà
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            throw new Exception("Cet email est déjà utilisé.");
        }
        
        // Vérifier si le username existe déjà
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            throw new Exception("Ce nom d'utilisateur est déjà pris.");
        }
        
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Insérer l'utilisateur
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword]);
    }
    
    public function login($emailOrUsername, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$emailOrUsername, $emailOrUsername]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = (bool)$user['is_admin'];
            return true;
        }
        return false;
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        session_start();
    }
    
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, username, email, is_admin, created_at FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT id, username, email, is_admin, avatar FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function updateUser($id, $username, $email, $isAdmin) {
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, is_admin = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $isAdmin, $id]);
    }
    
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

class Product {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function create($name, $description, $price, $image, $categoryId) {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, price, image, category_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $price, $image, $categoryId]);
    }
    
    public function getAll($limit = null, $offset = 0) {
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        // $sql = "SELECT p.*, c.name as category_name FROM products p 
        //         LEFT JOIN categories c ON p.category_id = c.id 
        //         ORDER BY p.created_at DESC";
        
        if ($limit !== null) {
            $sql .= " LIMIT ? OFFSET ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$limit, $offset]);
        } else {
            $stmt = $this->pdo->query($sql);
        }
        
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT p.*, c.name as category_name FROM products p 
                                     LEFT JOIN categories c ON p.category_id = c.id 
                                     WHERE p.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function update($id, $name, $description, $price, $image, $categoryId) {
        if ($image) {
            $stmt = $this->pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, category_id = ? WHERE id = ?");
            return $stmt->execute([$name, $description, $price, $image, $categoryId, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?");
            return $stmt->execute([$name, $description, $price, $categoryId, $id]);
        }
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function search($query, $categoryId = null, $minPrice = null, $maxPrice = null, $sortBy = 'name', $sortOrder = 'ASC') {
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE 1=1";
        $params = [];
        
        if ($query) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $searchTerm = "%$query%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        
        if ($categoryId) {
            $sql .= " AND p.category_id = ?";
            $params[] = $categoryId;
        }
        
        if ($minPrice !== null) {
            $sql .= " AND p.price >= ?";
            $params[] = $minPrice;
        }
        
        if ($maxPrice !== null) {
            $sql .= " AND p.price <= ?";
            $params[] = $maxPrice;
        }
        
        $allowedSort = ['name', 'price', 'created_at'];
        $sortBy = in_array($sortBy, $allowedSort) ? $sortBy : 'name';
        $sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';
        
        $sql .= " ORDER BY p.$sortBy $sortOrder";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM products");
        $result = $stmt->fetch();
        return $result['count'];
    }
}

class Category {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function create($name, $description, $parentId = null) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, description, parent_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $parentId]);
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT c.*, p.name as parent_name FROM categories c 
                                   LEFT JOIN categories p ON c.parent_id = p.id 
                                   ORDER BY c.name");
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function update($id, $name, $description, $parentId) {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = ?, description = ?, parent_id = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $parentId, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function getTree($parentId = null) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE parent_id " . ($parentId === null ? "IS NULL" : "= ?") . " ORDER BY name");
        if ($parentId !== null) {
            $stmt->execute([$parentId]);
        } else {
            $stmt->execute();
        }
        
        $categories = $stmt->fetchAll();
        foreach ($categories as &$category) {
            $category['children'] = $this->getTree($category['id']);
        }
        
        return $categories;
    }
}
?>