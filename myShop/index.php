<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("config.php/commands.php");
$Products = displayProducts();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Boutique en ligne - Découvrez nos produits de qualité">
    <meta name="keywords" content="boutique, e-commerce, produits">
    <title>Ma Boutique - Accueil</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style>
        /* Import Avenir font */
        @font-face {
            font-family: 'Avenir';
            src: local('Avenir Next'), local('Avenir');
            font-weight: normal;
            font-style: normal;
        }
        
        body {
            font-family: 'Avenir', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Roboto', sans-serif;
        }

        /* Animation pour le menu mobile */
        .menu-mobile {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .menu-mobile.active {
            max-height: 500px;
        }

        /* Animation fade-in pour les éléments au scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animation du panier */
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        
        .cart-bounce {
            animation: bounce 0.3s ease;
        }

        /* Modal du panier */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal.active {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #sign-in {
            display: none;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        #sign-in.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition">
                    Ma Boutique
                </a>
                
                <!-- Menu Desktop -->
                <nav class="hidden md:block">
                    <ul class="flex gap-8">
                        <li><a href="#accueil" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Accueil</a></li>
                        <li><a href="admin/product.php" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Produits</a></li>
                        <li><a href="#a-propos" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">À Propos</a></li>
                        <li><a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Contact</a></li>
                    </ul>
                </nav>

                <!-- Panier et Menu Burger -->
                <div class="flex items-center gap-8">
                    <!-- Bouton Panier -->
                    <div id="cart-btn" class="relative hover:bg-blue-600 transition">
                        <i class='bx bxs-cart'></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-4 h-4 flex items-center justify-center">0</span>
                    </div>

                    <!-- Menu Burger (mobile) -->
                
                    <i id="menu-toggle" class='bx bx-menu md:hidden' ></i>
                    <a href="signin.php"><i id="users-icon" class='bx bxs-user'></i></a>
                </div>
            </div>

            <!-- Menu Mobile -->
            <nav id="mobile-menu" class="menu-mobile md:hidden">
                <ul class="flex flex-col gap-4 pb-4 text-center">
                    <li><a href="#accueil" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Accueil</a></li>
                    <li><a href="#admin/product.php" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Produits</a></li>
                    <li><a href="#a-propos" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">À Propos</a></li>
                    <li><a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition smooth-scroll">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Modal Panier -->
    <div id="cart-modal" class="modal">
        <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-96 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Mon Panier</h2>
                <button id="close-modal" class="text-gray-500 hover:text-gray-800 text-3xl">×</button>
            </div>
            <div id="cart-items" class="space-y-4">
                <p class="text-gray-500 text-center py-8">Votre panier est vide</p>
            </div>
            <div class="border-t pt-4 mt-6">
                <div class="flex justify-between items-center text-xl font-bold">
                    <span>Total:</span>
                    <span id="cart-total" class="text-red-500">0.00€</span>
                </div>
                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg mt-4 transition">
                    Commander
                </button>
            </div>
        </div>
    </div>
    
    


    <!-- Hero Section -->
    <section id="accueil" class="bg-gradient-to-br from-blue-500 to-gray-800 text-white py-20 md:py-32 px-4 fade-in">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Bienvenue sur Ma Boutique</h1>
            <p class="text-xl md:text-2xl mb-8">Découvrez nos produits exceptionnels et profitez d'une expérience unique</p>
            <a href="#produits" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-4 rounded-lg transition transform hover:-translate-y-1 hover:shadow-xl smooth-scroll">
                Découvrir nos produits
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produits" class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12 fade-in">Nos Produits Phares</h2>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($Products as $product): ?>
                <!-- Product Card 1 -->
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="<?= $product->picture ?>" class="w-full h-full object-cover" alt="<?= $product->name ?>">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= $product->name ?></h3>
                        <p class="text-gray-600 mb-4"><?= $product->description ?></p>
                        <p class="text-3xl font-bold text-red-500 mb-4"><?= $product->price ?>€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Smartphone Pro" data-price="99.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article>

                <!-- Product Card 2 -->
                <!-- <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="/home/adjalala-kevin/Bureau/rendu/kevin.adjalala.repository/webIntegration/img/pc.jpeg" class="w-full h-full object-cover" alt="">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Laptop Ultra</h3>
                        <p class="text-gray-600 mb-4">Ordinateur portable puissant avec processeur Intel i9</p>
                        <p class="text-3xl font-bold text-red-500 mb-4">149.99€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Laptop Ultra" data-price="149.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article> -->

                <!-- Product Card 3 -->
                <!-- <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="/home/adjalala-kevin/Bureau/rendu/kevin.adjalala.repository/webIntegration/img/montre.jpeg" class="w-full h-full object-cover" alt="super montre">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Smartwatch Sport</h3>
                        <p class="text-gray-600 mb-4">Montre connectée avec suivi santé et GPS intégré</p>
                        <p class="text-3xl font-bold text-red-500 mb-4">79.99€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Smartwatch Sport" data-price="79.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article> -->

                <!-- Product Card 4 -->
                <!-- <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="/home/adjalala-kevin/Bureau/rendu/kevin.adjalala.repository/webIntegration/img/jpeg(17)" class="w-full h-full object-cover" alt="casque pro">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Casque Audio Pro</h3>
                        <p class="text-gray-600 mb-4">Réduction de bruit active et son haute qualité</p>
                        <p class="text-3xl font-bold text-red-500 mb-4">129.99€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Casque Audio Pro" data-price="129.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article> -->

                <!-- Product Card 5 -->
                <!-- <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="/home/adjalala-kevin/Bureau/rendu/kevin.adjalala.repository/webIntegration/img/Cámara Canon 90D.jpeg" class="w-full h-full object-cover" alt="ca">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Appareil Photo 4K</h3>
                        <p class="text-gray-600 mb-4">Caméra professionnelle avec stabilisation avancée</p>
                        <p class="text-3xl font-bold text-red-500 mb-4">199.99€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Appareil Photo 4K" data-price="199.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article> -->

                <!-- Product Card 6 -->
                <!-- <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300 fade-in">
                    <div class="bg-gray-100 h-64 flex items-center justify-center overflow-hidden">
                        <img src="/home/adjalala-kevin/Bureau/rendu/kevin.adjalala.repository/webIntegration/img/Game Controller 🎮🕹.jpeg" class="w-full h-full object-cover" alt="gaming">
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Console Gaming</h3>
                        <p class="text-gray-600 mb-4">Dernière génération avec graphismes 4K</p>
                        <p class="text-3xl font-bold text-red-500 mb-4">89.99€</p>
                        <button class="add-to-cart w-full bg-red-500 hover:bg-red-600 text-white text-center font-semibold py-3 rounded-lg transition" data-name="Console Gaming" data-price="89.99">
                            Ajouter au panier
                        </button>
                    </div>
                </article> -->
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section id="a-propos" class="bg-gray-100 py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12 fade-in">Pourquoi Nous Choisir ?</h2>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
                        🚚
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Livraison Rapide</h3>
                    <p class="text-gray-600">Recevez vos commandes en 24-48h partout en France</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
                        🔒
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Paiement Sécurisé</h3>
                    <p class="text-gray-600">Vos transactions sont 100% sécurisées</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
                        💬
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Support 24/7</h3>
                    <p class="text-gray-600">Notre équipe est disponible à tout moment</p>
                </div>

                <!-- Feature 4 -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
                        ↩️
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Retours Gratuits</h3>
                    <p class="text-gray-600">30 jours pour changer d'avis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-800 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Footer Section 1 -->
                <div>
                    <h3 class="text-xl font-bold mb-4">À Propos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Qui sommes-nous ?</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Notre histoire</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Nos valeurs</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Carrières</a></li>
                    </ul>
                </div>

                <!-- Footer Section 2 -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Aide</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Livraison</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Retours</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Garantie</a></li>
                    </ul>
                </div>

                <!-- Footer Section 3 -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li><a href="mailto:contact@maboutique.fr" class="text-gray-300 hover:text-white transition">contact@maboutique.fr</a></li>
                        <li><a href="tel:+33123456789" class="text-gray-300 hover:text-white transition">+33 1 23 45 67 89</a></li>
                        <li class="text-gray-300">123 Rue de la Boutique</li>
                        <li class="text-gray-300">75001 Paris, France</li>
                    </ul>
                </div>

                <!-- Footer Section 4 -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Suivez-nous</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Facebook</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Instagram</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Twitter</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">LinkedIn</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 Ma Boutique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // ===== VARIABLES GLOBALES =====
        let cart = [];
        const cartCount = document.getElementById('cart-count');
        const cartBtn = document.getElementById('cart-btn');
        const cartModal = document.getElementById('cart-modal');
        const closeModal = document.getElementById('close-modal');
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const signIn = document.getElementById('sign-in');
        const userIcon = document.getElementById('users-icon');

        // ===== 1. MENU BURGER (Mobile) =====
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuToggle.textContent = mobileMenu.classList.contains('active') ? '✕' : '☰';
        });

        // Fermer le menu quand on clique sur un lien
        document.querySelectorAll('.smooth-scroll').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                menuToggle.textContent = '☰';
            });
        }); 

        // ===== 2. SMOOTH SCROLL =====
        document.querySelectorAll('.smooth-scroll').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // ===== 3. ANIMATION AU SCROLL =====
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observer tous les éléments avec la classe fade-in
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // ===== 4. SYSTÈME DE PANIER =====
        
        // Ajouter un produit au panier
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const productName = button.getAttribute('data-name');
                const productPrice = parseFloat(button.getAttribute('data-price'));
                
                // Vérifier si le produit existe déjà dans le panier
                const existingProduct = cart.find(item => item.name === productName);
                
                if (existingProduct) {
                    existingProduct.quantity++;
                } else {
                    cart.push({
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    });
                }
                
                updateCart();
                
                // Animation du bouton panier
                cartBtn.classList.add('cart-bounce');
                setTimeout(() => cartBtn.classList.remove('cart-bounce'), 300);
                
                // Feedback visuel
                button.textContent = '✓ Ajouté !';
                button.classList.add('bg-green-500', 'hover:bg-green-600');
                button.classList.remove('bg-red-500', 'hover:bg-red-600');
                
                setTimeout(() => {
                    button.textContent = 'Ajouter au panier';
                    button.classList.remove('bg-green-500', 'hover:bg-green-600');
                    button.classList.add('bg-red-500', 'hover:bg-red-600');
                }, 1000);
            });
        });

        // Mettre à jour l'affichage du panier
        function updateCart() {
            // Mettre à jour le compteur
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
            
            // Mettre à jour le contenu du modal
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-gray-500 text-center py-8">Votre panier est vide</p>';
                cartTotal.textContent = '0.00€';
            } else {
                cartItems.innerHTML = cart.map(item => `
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-800">${item.name}</h4>
                            <p class="text-gray-600">Prix unitaire: ${item.price.toFixed(2)}€</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <button class="decrease-qty bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-3 py-1 rounded" data-name="${item.name}">-</button>
                                <span class="font-bold text-lg">${item.quantity}</span>
                                <button class="increase-qty bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-3 py-1 rounded" data-name="${item.name}">+</button>
                            </div>
                            <span class="font-bold text-lg w-24 text-right">${(item.price * item.quantity).toFixed(2)}€</span>
                            <button class="remove-item text-red-500 hover:text-red-700 text-2xl" data-name="${item.name}">×</button>
                        </div>
                    </div>
                `).join('');
                
                // Calculer le total
                const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                cartTotal.textContent = total.toFixed(2) + '€';
                
                // Ajouter les événements pour les boutons du panier
                addCartEventListeners();
            }
        }

        // Ajouter les événements pour les boutons du panier
        function addCartEventListeners() {
            // Augmenter la quantité
            document.querySelectorAll('.increase-qty').forEach(btn => {
                btn.addEventListener('click', () => {
                    const productName = btn.getAttribute('data-name');
                    const product = cart.find(item => item.name === productName);
                    if (product) {
                        product.quantity++;
                        updateCart();
                    }
                });
            });
            
            // Diminuer la quantité
            document.querySelectorAll('.decrease-qty').forEach(btn => {
                btn.addEventListener('click', () => {
                    const productName = btn.getAttribute('data-name');
                    const product = cart.find(item => item.name === productName);
                    if (product) {
                        product.quantity--;
                        if (product.quantity <= 0) {
                            cart = cart.filter(item => item.name !== productName);
                        }
                        updateCart();
                    }
                });
            });
            
            // Supprimer un article
            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', () => {
                    const productName = btn.getAttribute('data-name');
                    cart = cart.filter(item => item.name !== productName);
                    updateCart();
                });
            });
        }

        // Ouvrir/Fermer le modal du panier
        cartBtn.addEventListener('click', () => {
            cartModal.classList.add('active');
        });

        closeModal.addEventListener('click', () => {
            cartModal.classList.remove('active');
        });

        // Fermer le modal en cliquant en dehors
        cartModal.addEventListener('click', (e) => {
            if (e.target === cartModal) {
                cartModal.classList.remove('active');
            }
        });

        // ===== 5. BOUTON RETOUR EN HAUT =====
        const scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.innerHTML = '↑';
        scrollToTopBtn.className = 'fixed bottom-8 right-8 bg-blue-500 hover:bg-blue-600 text-white font-bold w-12 h-12 rounded-full shadow-lg transition opacity-0 pointer-events-none z-50';
        scrollToTopBtn.id = 'scroll-to-top';
        document.body.appendChild(scrollToTopBtn);

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.style.opacity = '1';
                scrollToTopBtn.style.pointerEvents = 'auto';
            } else {
                scrollToTopBtn.style.opacity = '0';
                scrollToTopBtn.style.pointerEvents = 'none';
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // ===== MESSAGE DE BIENVENUE =====
        console.log('🎉 Bienvenue sur Ma Boutique ! Le site est maintenant interactif.');
        userIcon.addEventListener('click', () => {
            signIn.classList.toggle('active');
        });
    </script>

