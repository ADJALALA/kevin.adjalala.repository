@extends('layouts.app')

@section('title', isset($produit) ? 'Modifier Produit' : 'Nouveau Produit')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">
            {{ isset($produit) ? 'Modifier le Produit' : 'Nouveau Produit' }}
        </h2>

        <form method="POST" action="{{ isset($produit) ? route('produits.update', $produit) : route('produits.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($produit))
                @method('PUT')
            @endif

            <div class="space-y-4">
                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom du Produit *</label>
                    <input type="text" name="nom" value="{{ old('nom', $produit->nom ?? '') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('nom') border-red-500 @enderror" required>
                    @error('nom')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Code-Barres -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Code-Barres *</label>
                    <input type="text" name="code_barre" value="{{ old('code_barre', $produit->code_barre ?? '') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('code_barre') border-red-500 @enderror" required>
                    @error('code_barre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                    <select name="categorie_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('categorie_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('categorie_id', $produit->categorie_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Format -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Format *</label>
                    <input type="text" name="format" value="{{ old('format', $produit->format ?? '') }}" 
                           placeholder="Ex: Bouteille 65cl, Canette 33cl" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('format') border-red-500 @enderror" required>
                    @error('format')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Prix -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prix Unitaire (FCFA) *</label>
                        <input type="number" name="prix_unitaire" value="{{ old('prix_unitaire', $produit->prix_unitaire ?? '') }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('prix_unitaire') border-red-500 @enderror" required>
                        @error('prix_unitaire')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seuil Alerte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Seuil d'Alerte *</label>
                        <input type="number" name="seuil_alerte" value="{{ old('seuil_alerte', $produit->seuil_alerte ?? 50) }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('seuil_alerte') border-red-500 @enderror" required>
                        @error('seuil_alerte')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                @if(!isset($produit))
                <!-- Stock Initial -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stock Initial *</label>
                    <input type="number" name="stock_actuel" value="{{ old('stock_actuel', 0) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('stock_actuel') border-red-500 @enderror" required>
                    @error('stock_actuel')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image du Produit</label>
                    <input type="file" name="image" accept="image/*" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Boutons -->
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 font-semibold">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($produit) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('produits.index') }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-semibold text-center">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection