@extends('layouts.app')

@section('title', 'Nouvelle Vente - SOBEBRA')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Nouvelle Vente</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Liste des Produits -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Produits Disponibles</h3>
            
            <div class="mb-4">
                <input type="text" id="searchProduit" placeholder="Rechercher un produit..." 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div id="produitsList" class="space-y-2 max-h-96 overflow-y-auto">
                @foreach($produits as $produit)
                <div class="produit-item flex items-center justify-between p-3 border rounded hover:bg-gray-50 cursor-pointer" 
                     data-id="{{ $produit->id }}"
                     data-nom="{{ $produit->nom }}"
                     data-prix="{{ $produit->prix_unitaire }}"
                     data-stock="{{ $produit->stock_actuel }}">
                    <div class="flex items-center gap-3">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold">{{ $produit->nom }}</p>
                            <p class="text-sm text-gray-600">{{ $produit->format }} - {{ number_format($produit->prix_unitaire) }} FCFA</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Stock: {{ $produit->stock_actuel }}</p>
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Panier -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4">Panier</h3>
            
            <div id="panier" class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                <p class="text-gray-500 text-center py-8">Panier vide</p>
            </div>

            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total:</span>
                    <span id="totalVente">0 FCFA</span>
                </div>
                
                <form method="POST" action="{{ route('ventes.store') }}" id="venteForm">
                    @csrf
                    <input type="hidden" name="produits" id="produitsData">
                    <button type="submit" id="btnValider" disabled 
                            class="w-full bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 disabled:bg-gray-300 disabled:cursor-not-allowed">
                        <i class="fas fa-check mr-2"></i>
                        Valider la Vente
                    </button>
                </form>
                
                <button id="btnVider" class="w-full bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600">
                    <i class="fas fa-trash mr-2"></i>
                    Vider le Panier
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let panier = [];

// Recherche produit
document.getElementById('searchProduit').addEventListener('input', function(e) {
    const search = e.target.value.toLowerCase();
    document.querySelectorAll('.produit-item').forEach(item => {
        const nom = item.dataset.nom.toLowerCase();
        item.style.display = nom.includes(search) ? 'flex' : 'none';
    });
});

// Ajouter au panier
document.querySelectorAll('.produit-item button').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const item = this.closest('.produit-item');
        const id = item.dataset.id;
        const nom = item.dataset.nom;
        const prix = parseFloat(item.dataset.prix);
        const stock = parseInt(item.dataset.stock);
        
        const existant = panier.find(p => p.id === id);
        if (existant) {
            if (existant.quantite < stock) {
                existant.quantite++;
            } else {
                alert('Stock insuffisant');
                return;
            }
        } else {
            panier.push({ id, nom, prix, quantite: 1, stock });
        }
        
        afficherPanier();
    });
});

function afficherPanier() {
    const panierDiv = document.getElementById('panier');
    const btnValider = document.getElementById('btnValider');
    
    if (panier.length === 0) {
        panierDiv.innerHTML = '<p class="text-gray-500 text-center py-8">Panier vide</p>';
        btnValider.disabled = true;
        document.getElementById('totalVente').textContent = '0 FCFA';
        return;
    }
    
    btnValider.disabled = false;
    
    let html = '';
    let total = 0;
    
    panier.forEach((item, index) => {
        const sousTotal = item.prix * item.quantite;
        total += sousTotal;
        
        html += `
            <div class="border rounded p-3">
                <div class="flex justify-between items-start mb-2">
                    <p class="font-semibold text-sm">${item.nom}</p>
                    <button onclick="retirerProduit(${index})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <button onclick="modifierQuantite(${index}, -1)" class="bg-gray-200 w-6 h-6 rounded hover:bg-gray-300">
                            <i class="fas fa-minus text-xs"></i>
                        </button>
                        <span class="font-semibold">${item.quantite}</span>
                        <button onclick="modifierQuantite(${index}, 1)" class="bg-gray-200 w-6 h-6 rounded hover:bg-gray-300">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                    </div>
                    <p class="font-semibold">${sousTotal.toLocaleString()} F</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">${item.prix.toLocaleString()} F × ${item.quantite}</p>
            </div>
        `;
    });
    
    panierDiv.innerHTML = html;
    document.getElementById('totalVente').textContent = total.toLocaleString() + ' FCFA';
}

function modifierQuantite(index, delta) {
    const item = panier[index];
    const nouvelleQte = item.quantite + delta;
    
    if (nouvelleQte <= 0) {
        panier.splice(index, 1);
    } else if (nouvelleQte <= item.stock) {
        item.quantite = nouvelleQte;
    } else {
        alert('Stock insuffisant');
        return;
    }
    
    afficherPanier();
}

function retirerProduit(index) {
    panier.splice(index, 1);
    afficherPanier();
}

document.getElementById('btnVider').addEventListener('click', function() {
    if (confirm('Vider le panier ?')) {
        panier = [];
        afficherPanier();
    }
});

document.getElementById('venteForm').addEventListener('submit', function(e) {
    if (panier.length === 0) {
        e.preventDefault();
        alert('Le panier est vide');
        return;
    }
    
    const produitsData = panier.map(item => ({
        id: item.id,
        quantite: item.quantite
    }));
    
    document.getElementById('produitsData').value = JSON.stringify(produitsData);
});
</script>
@endpush
@endsection