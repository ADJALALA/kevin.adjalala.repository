
CREATE DATABASE IF NOT EXISTS my_shop;
USE my_shop;

-- Table des utilisateurs
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    avatar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories (avec support de hiérarchie)
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    parent_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Table des produits
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Table de l'historique des produits visités (bonus)
CREATE TABLE product_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    visited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insertion d'un admin par défaut (password: admin123)
INSERT INTO users (username, email, password, is_admin) 
VALUES ('admin', 'admin@myshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE);

-- Catégories exemples
INSERT INTO categories (name, description, parent_id) VALUES
('Meubles', 'Tous les meubles pour votre maison', NULL),
('Électronique', 'Appareils et gadgets électroniques', NULL),
('Vêtements', 'Mode pour tous', NULL);

INSERT INTO categories (name, description, parent_id) VALUES
('Chaises', 'Différents types de chaises', 1),
('Tables', 'Tables de toutes tailles', 1);

INSERT INTO categories (name, description, parent_id) VALUES
('Chaises en bois', 'Chaises fabriquées en bois', 4),
('Chaises en plastique', 'Chaises en plastique résistant', 4);

-- Produits exemples
INSERT INTO products (name, description, price, image, category_id) VALUES
('Chaise moderne', 'Chaise design en bois massif', 89.99, 'chair1.jpg', 6),
('Chaise de bureau', 'Chaise ergonomique pour bureau', 149.99, 'chair2.jpg', 7),
('Table à manger', 'Table en chêne pour 6 personnes', 399.99, 'table1.jpg', 5),
('Smartphone XY', 'Dernier modèle haute performance', 699.99, 'phone1.jpg', 2),
('T-shirt coton', 'T-shirt 100% coton bio', 29.99, 'tshirt1.jpg', 3);