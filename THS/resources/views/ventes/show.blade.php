@extends('layouts.app')

@section('title', 'Détail Vente - SOBEBRA')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détail de la Vente {{ $vente->numero_vente }}</h2>
        <a href="{{ route('ventes.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Retour
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm mb-1">Date de vente</p>
            <p class="text-xl font-bold">{{ $vente->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm mb-1">Vendeur</p>
            <p class="text-xl font-bold">{{ $vente->user->name }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 text-sm mb-1">Statut</p>
            @if($vente->statut === 'completee')
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded font-semibold">
                    <i class="fas fa-check-circle mr-2"></i> Complétée
                </span>
            @endif
        </div>
    </div>

    <!-- Articles vendus -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="bg-gray-50 px-6 py-3 border-b">
            <h3 class="font-bold">Articles vendus</h3>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Produit</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Prix Unitaire</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Quantité</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Sous-total</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($vente->details as $detail)
                <tr>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-semibold">{{ $detail->produit->nom }}</p>
                            <p class="text-sm text-gray-600">{{ $detail->produit->format }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ number_format($detail->prix_unitaire) }} FCFA</td>
                    <td class="px-6 py-4 font-semibold">{{ $detail->quantite }}</td>
                    <td class="px-6 py-4 font-bold">{{ number_format($detail->sous_total) }} FCFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total -->
    <div class="bg-yellow-50 rounded-lg shadow p-6 border-2 border-yellow-500">
        <div class="flex justify-between items-center">
            <span class="text-2xl font-bold">Montant Total</span>
            <span class="text-3xl font-bold text-yellow-600">{{ number_format($vente->montant_total) }} FCFA</span>
        </div>
    </div>

    <!-- Bouton d'impression -->
    <div class="mt-6 text-center">
        <button onclick="window.print()" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
            <i class="fas fa-print mr-2"></i>
            Imprimer le reçu
        </button>
    </div>
</div>
@endsection