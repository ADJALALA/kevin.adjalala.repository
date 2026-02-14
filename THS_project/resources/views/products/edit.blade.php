@extends('layouts.app')

@section('title', 'Modifier Produit')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Modifier le Produit</h2>

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom du Produit *</label>
                    <input type="text" name="nom" value="{{ old('name', $product->name) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('nom') border-red-500 @enderror" required>
                    @error('nom')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Code-Barres *</label>
                    <input type="text" name="code_barre" value="{{ old('code_barre', $product->code_barre) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('code_barre') border-red-500 @enderror" required>
                    @error('code_barre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                    <select name="categorie_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('categorie_id') border-red-500 @enderror" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('categorie_id', $product->categorie_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Format *</label>
                    <input type="text" name="format" value="{{ old('format', $product->format) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('format') border-red-500 @enderror" required>
                    @error('format')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prix Unitaire (FCFA) *</label>
                        <input type="number" name="prix_unitaire" value="{{ old('prix_unitaire', $product->prix_unitaire) }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('prix_unitaire') border-red-500 @enderror" required>
                        @error('prix_unitaire')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Seuil d'Alerte *</label>
                        <input type="number" name="seuil_alerte" value="{{ old('seuil_alerte', $product->seuil_alerte) }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('seuil_alerte') border-red-500 @enderror" required>
                        @error('seuil_alerte')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stock Actuel</label>
                    <p class="text-2xl font-bold text-green-600">{{ $product->stock_actuel }} unités</p>
                    <p class="text-sm text-gray-500 mt-1">Le stock se modifie automatiquement lors des ventes</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image du Produit</label>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="image" accept="image/*" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 font-semibold">
                        <i class="fas fa-save mr-2"></i>
                        Mettre à jour
                    </button>
                    <a href="{{ route('products.index') }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 font-semibold text-center">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection