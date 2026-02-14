<?php
require_once("connect_db.php");
/**
 * Ajouter un produit dans la base de données
 */
function addProducts($picture, $name, $price, $desc) {
    try {
        // ✅ CORRECTION : Récupérer le retour de connect_db.php
        $pdo = getDbConnection();
        
        // Utiliser les placeholders pour éviter l'injection SQL
        $req = $pdo->prepare("INSERT INTO product(picture, name, price, description) VALUES(?, ?, ?, ?)");
        
        // Passer les valeurs dans execute()
        $result = $req->execute(array($picture, $name, $price, $desc));
        
        $req->closeCursor();
        
        return $result;
        
    } catch (PDOException $e) {
        error_log("Erreur addProducts: " . $e->getMessage());
        throw new Exception("Erreur lors de l'ajout du produit: " . $e->getMessage());
    }
}

/**
 * Afficher tous les produits
 */
function displayProducts() {
    try {
        // ✅ Récupérer la connexion
        $pdo = getDbConnection();
        
        $req = $pdo->prepare("SELECT * FROM product ORDER BY name ASC");
        $req->execute();
        
        // ✅ FETCH_OBJ car votre connect_db utilise FETCH_ASSOC par défaut
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        
        $req->closeCursor();
        
        return $data;
        
    } catch (PDOException $e) {
        error_log("Erreur displayProducts: " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération des produits: " . $e->getMessage());
    }
}

/**
 * Supprimer un produit
 */
function deleteProducts($id) {
    try {
        // ✅ Récupérer la connexion
        $pdo = getDbConnection();
        
        // CORRECTION: DELETE FROM (pas DELETE *)
        $req = $pdo->prepare("DELETE FROM product WHERE id = ?");
        
        $result = $req->execute(array($id));
        
        $req->closeCursor();
        
        return $result;
        
    } catch (PDOException $e) {
        error_log("Erreur deleteProducts: " . $e->getMessage());
        throw new Exception("Erreur lors de la suppression du produit: " . $e->getMessage());
    }
}

/**
 * Récupérer un produit par son ID
 */
function getProductById($id) {
    try {
        $pdo = getDbConnection();
        
        $req = $pdo->prepare("SELECT * FROM product WHERE id = ?");
        $req->execute(array($id));
        
        $data = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        
        return $data;
        
    } catch (PDOException $e) {
        error_log("Erreur getProductById: " . $e->getMessage());
        throw new Exception("Erreur lors de la récupération du produit: " . $e->getMessage());
    }
}

/**
 * Mettre à jour un produit
 */
function updateProduct($id, $picture, $name, $price, $desc) {
    try {
        $pdo = getDbConnection();
        
        $req = $pdo->prepare("UPDATE product SET picture = ?, name = ?, price = ?, description = ? WHERE id = ?");
        $result = $req->execute(array($picture, $name, $price, $desc, $id));
        
        $req->closeCursor();
        
        return $result;
        
    } catch (PDOException $e) {
        error_log("Erreur updateProduct: " . $e->getMessage());
        throw new Exception("Erreur lors de la mise à jour du produit: " . $e->getMessage());
    }
}