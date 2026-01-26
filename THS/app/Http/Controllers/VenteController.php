<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\MouvementStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    public function create()
    {
        $produits = Produit::where('stock_actuel', '>', 0)->get();
        return view('ventes.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produits' => 'required|json',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);
        $produitsArray = json_decode($request->produits, true);

        DB::transaction(function () use ($produitsArray) {
            $vente = Vente::create([
                'user_id' => auth()->id(),
                'montant_total' => 0,
                'statut' => 'completee'
            ]);

            $montantTotal = 0;

            foreach ($produitsArray as $item) {
                $produit = Produit::findOrFail($item['id']);
                
                if ($produit->stock_actuel < $item['quantite']) {
                    throw new \Exception("Stock insuffisant pour {$produit->nom}");
                }

                $sousTotal = $produit->prix_unitaire * $item['quantite'];
                $montantTotal += $sousTotal;

                $vente->details()->create([
                    'produit_id' => $produit->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $produit->prix_unitaire,
                    'sous_total' => $sousTotal
                ]);

                // Mise à jour du stock
                $stockAvant = $produit->stock_actuel;
                $produit->decrement('stock_actuel', $item['quantite']);

                MouvementStock::create([
                    'produit_id' => $produit->id,
                    'type' => 'sortie',
                    'quantite' => $item['quantite'],
                    'stock_avant' => $stockAvant,
                    'stock_apres' => $produit->stock_actuel,
                    'motif' => 'Vente #' . $vente->numero_vente,
                    'user_id' => auth()->id()
                ]);
            }

            $vente->update(['montant_total' => $montantTotal]);
        });

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès');
    }

    public function index()
    {
        $ventes = Vente::with('user')->latest()->paginate(20);
        return view('ventes.index', compact('ventes'));
    }

    public function show(Vente $vente)
    {
        $vente->load('details.produit');
        return view('ventes.show', compact('vente'));
    }
}