@extends('layouts.app')

@section('title', 'Tableau de Bord - SOBEBRA')

@section('content')
<div class="space-y-6">
    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Produits Total</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['total_produits'] }}</p>
                </div>
                <div class="bg-blue-500 p-3 rounded-lg">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Stock Total</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($stats['stock_total']) }}</p>
                </div>
                <div class="bg-green-500 p-3 rounded-lg">
                    <i class="fas fa-warehouse text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Alertes Stock</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['alertes'] }}</p>
                </div>
                <div class="bg-red-500 p-3 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Ventes du Jour</p>
                    <p class="text-3xl font-bold mt-2">{{ $stats['ventes_jour'] }}</p>
                </div>
                <div class="bg-purple-500 p-3 rounded-lg">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">CA du Jour</p>
                    <p class="text-2xl font-bold mt-2">{{ number_format($stats['ca_jour']) }} F</p>
                </div>
                <div class="bg-yellow-500 p-3 rounded-lg">
                    <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Alertes de Stock -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-red-500"></i>
                Alertes de Stock
            </h3>
            @if($produitsAlerte->count() > 0)
                <div class="space-y-3">
                    @foreach($produitsAlerte as $produit)
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded border-l-4 border-red-500">
                        <div>
                            <p class="font-semibold">{{ $produit->nom }}</p>
                            <p class="text-sm text-gray-600">{{ $produit->format }} - {{ $produit->categorie->nom }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-red-600 font-bold">{{ $produit->stock_actuel }} unités</p>
                            <p class="text-xs text-gray-500">Seuil: {{ $produit->seuil_alerte }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Aucune alerte de stock</p>
            @endif
        </div>

        <!-- Top Ventes -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                <i class="fas fa-trophy text-yellow-500"></i>
                Top 5 Produits
            </h3>
            @if($topVentes->count() > 0)
                <div class="space-y-3">
                    @foreach($topVentes as $index => $vente)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                        <div class="flex items-center gap-3">
                            <span class="bg-yellow-500 text-white font-bold w-8 h-8 rounded-full flex items-center justify-center">
                                {{ $index + 1 }}
                            </span>
                            <p class="font-semibold">{{ $vente->nom }}</p>
                        </div>
                        <p class="text-green-600 font-bold">{{ number_format($vente->total_vendu) }} vendus</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Aucune vente enregistrée</p>
            @endif
        </div>
    </div>
</div>
@endsection