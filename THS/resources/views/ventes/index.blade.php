@extends('layouts.app')

@section('title', 'Historique des Ventes - SOBEBRA')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Historique des Ventes</h2>
        <a href="{{ route('ventes.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-yellow-600">
            <i class="fas fa-plus"></i>
            Nouvelle Vente
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">N° Vente</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Vendeur</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Montant</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($ventes as $vente)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold">{{ $vente->numero_vente }}</td>
                    <td class="px-6 py-4 text-sm">{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $vente->user->name }}</td>
                    <td class="px-6 py-4 font-bold text-green-600">{{ number_format($vente->montant_total) }} FCFA</td>
                    <td class="px-6 py-4">
                        @if($vente->statut === 'completee')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                <i class="fas fa-check-circle"></i> Complétée
                            </span>
                        @elseif($vente->statut === 'en_cours')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">
                                <i class="fas fa-clock"></i> En cours
                            </span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">
                                <i class="fas fa-times-circle"></i> Annulée
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('ventes.show', $vente) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i> Détails
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Aucune vente enregistrée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $ventes->links() }}
    </div>
</div>
@endsection