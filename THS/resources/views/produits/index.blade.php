@extends('layouts.app')

@section('title', 'Gestion des Produits - SOBEBRA')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Gestion des Produits</h2>
        <a href="{{ route('produits.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-yellow-600">
            <i class="fas fa-plus"></i>
            Nouveau Produit
        </a>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="{{ route('produits.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Rechercher un produit..." 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <select name="categorie" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('categorie') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nom }}
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
                @forelse($produits as $produit)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $produit->nom }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $produit->code_barre }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                            {{ $produit->categorie->nom }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $produit->format }}</td>
                    <td class="px-6 py-4">
                        <span class="font-semibold {{ $produit->isAlerte() ? 'text-red-600' : 'text-green-600' }}">
                            {{ $produit->stock_actuel }}
                            @if($produit->isAlerte())
                                <i class="fas fa-exclamation-triangle text-red-500 ml-1"></i>
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($produit->prix_unitaire) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-4 items-center">
                            <!-- Modifier -->
                            <a href="{{ route('produits.edit', $produit) }}" 
                            class="text-blue-600 hover:text-blue-800 transition" 
                            title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Supprimer -->
                            @if($produit->canBeDeleted())
                                <form method="POST" 
                                    action="{{ route('produits.destroy', $produit) }}" 
                                    onsubmit="return confirmDelete('{{ $produit->nom }}')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition" 
                                            title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400" title="Ce produit a des ventes et ne peut pas être supprimé">
                                    <i class="fas fa-lock"></i>
                                </span
                            @endif
                        </div>
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
        {{ $produits->links() }}
    </div>
</div>
@endsection
@push('scripts')
<script>
function confirmDelete(productName) {
    return confirm(
        '⚠️ ATTENTION !\n\n' +
        'Voulez-vous vraiment supprimer "' + productName + '" ?\n\n' +
        '❌ Cette action est IRRÉVERSIBLE !\n' +
        '❌ Toutes les données liées seront perdues !\n\n' +
        'Cliquez sur OK pour confirmer la suppression.'
    );
}
</script>
@endpush