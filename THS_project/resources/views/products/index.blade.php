@extends('layouts.app')

@section('title', 'Gestion des Produits - SOBEBRA')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Gestion des Products</h2>
        <a href="{{ route('products.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-yellow-600">
            <i class="fas fa-plus"></i>
            Nouveau Produit
        </a>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="{{ route('products.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Rechercher un produit..." 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <select name="categorie" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('categorie') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>

    <!-- Liste des Produits -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Produit</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Code-Barres</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Format</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Prix (FCFA)</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->code_barre }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                            {{ $product->categorie->nom }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->format }}</td>
                    <td class="px-6 py-4">
                        <span class="font-semibold {{ $product->isAlerte() ? 'text-red-600' : 'text-green-600' }}">
                            {{ $product->stock_actuel }}
                            @if($product->isAlerte())
                                <i class="fas fa-exclamation-triangle text-red-500 ml-1"></i>
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($product->prix_unitaire) }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Aucun produit trouvé
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection