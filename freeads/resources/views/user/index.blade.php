<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeAds - Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header avec HOME à gauche et Post Ads + Login à droite -->
    <header class="bg-white shadow-sm py-4 px-6">
        <div class="flex justify-between items-center">

            <h1 class="text-xl font-bold text-gray-800">HOME</h1>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-blue-600">Post Ads +</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Sign up
                </a>
            </div>

        </div>
    </header>

    <!-- Barre de recherche simple -->
    <div class="bg-white border-b border-gray-200 py-3 px-6">
        <div class="flex items-center max-w-3xl mx-auto">
            <i class="fas fa-search text-gray-400 mr-3"></i>
            <input type="text" placeholder="Search..." class="w-full py-1 px-2 border-b border-gray-300 focus:outline-none focus:border-blue-500">
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <!-- Contenu principal avec sidebar et annonces -->
        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar de filtres --> 
            <aside class="lg:w-1/4 mb-6 lg:mb-0 lg:mr-6">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">PLOTS BY</h2>

                    <!-- Catégorie -->
             <div class="mb-4">
                        <h3 class="font-medium text-gray-600 mb-2">Category</h3>
                        <select class="w-full p-2 border border-gray-300 rounded-md bg-white">
                            <option>All</option>
                            <option>Electronics</option>
                            <option>Vehicles</option>
                            <option>Property</option>
                        </select>
                    </div> 

            <!-- Localisation -->
             <div class="mb-4">
                        <h3 class="font-medium text-gray-600 mb-2">Location</h3>
                        <input type="text" value="" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <!-- Prix -->
             <div class="mb-4">
                        <h3 class="font-medium text-gray-600 mb-2">Price Range</h3>
                        <div class="flex items-center space-x-2">
                            <input type="number" placeholder="0" class="w-full p-2 border border-gray-300 rounded-md">
                            <span class="text-gray-500">-</span>
                            <input type="number" placeholder="1200" class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                    </div> 

            <!-- Condition -->
             <div class="mb-4">
                        <h3 class="font-medium text-gray-600 mb-2">Condition</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox text-blue-600">
                                <span class="ml-2 text-gray-700">New</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox text-blue-600">
                                <span class="ml-2 text-gray-700">Good</span>
                            </label>
                            <label class="flex items-center"> 
                                <input type="checkbox" class="form-checkbox text-blue-600">
                                <span class="ml-2 text-gray-700">Used</span>
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Section des annonces -->
            <main class="lg:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- Annonce 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/img/nitendo.jpg" alt="" />
                        <div class="p-4">
                            <!-- <img src="{{ asset('/img/nitendo.jpg') }}" alt="description of myimage"/> -->
                            <h3 class="text-xl font-bold text-gray-800">Nintendo Switch</h3>
                            <p class="text-gray-600 mt-1">Voice device</p>
                            <p class="text-gray-500 text-sm mt-2">VISO MKTGD: MKTG/UdKBT E0/IPH</p>
                        </div>
                        <div class="px-4 py-3 bg-gray-100">
                            <p class="text-sm text-gray-600">Par <span class="font-medium">KevinDv13</span></p>
                        </div>
                    </div>

                    <!-- Annonce 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/img/vtt.jpg" alt="" />
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800">Velo</h3>
                            <p class="text-gray-600 mt-1">Estimator of your</p>
                            <p class="text-gray-500 text-sm mt-2">TEL FAUSTMITTER : AUGUST GDO, OAK</p>
                            <p class="text-gray-500 text-sm mt-1">VISION LEARNING: VISIONS DOLLER INNIAL</p>
                        </div>
                        <div class="px-4 py-3 bg-gray-100">
                            <p class="text-sm text-gray-600">Par <span class="font-medium">User Fabula</span></p>
                        </div>
                    </div>

                    <!-- Annonce 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/img/ipsel.jpg" alt="" />
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800">Ipsel</h3>
                            <p class="text-gray-600 mt-1">PRODUCTION</p>
                            <p class="text-gray-500 text-sm mt-2">TEL FAUSTMITTER ET AUGUST GDO, OAK</p>
                            <p class="text-gray-500 text-sm mt-1">VISION LEARNING: VISIONS DOLLER INNIAL</p>
                        </div>
                        <div class="px-4 py-3 bg-gray-100">
                            <p class="text-sm text-gray-600">Par <span class="font-medium">User Fabula</span></p>
                        </div>
                    </div>

                    <!-- Annonce 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/img/canon.jpg" alt="" />
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800">Reflex - Canon</h3>
                            <p class="text-gray-600 mt-1">COSTEA</p>
                            <p class="text-gray-500 text-sm mt-2">TEL FAUSTMITTER ET AUGUST GDO, OAK</p>
                            <p class="text-gray-500 text-sm mt-1">VISION LEARNING: VISIONS DOLLER INNIAL</p>
                        </div>
                        <div class="px-4 py-3 bg-gray-100">
                            <p class="text-sm text-gray-600">Par <span class="font-medium">Scrooge McDuck</span></p>
                        </div>
                    </div>

                    <!-- Annonce 5 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-800">Par Round Alpha</h3>
                            <p class="text-2xl font-bold text-blue-600 mt-2">2500 €</p>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100">Previous</a>
                        <a href="#" class="px-4 py-2 rounded bg-blue-600 text-white">1</a>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100">2</a>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100">3</a>
                        <a href="#" class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100">Next</a>
                    </nav>
                </div>
            </main>
        </div>
    </div>
</body>





<footer class="bg-white shadow-sm dark:bg-blue-900 m-0">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
    </div>
</footer>




</html>