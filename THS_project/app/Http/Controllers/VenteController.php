<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Product;
use App\Models\MouvementStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    public function create()
    {
        $products = Product::where('stock_actuel', '>', 0)->get();
        return view('ventes.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|json',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantite' => 'required|integer|min:1',
        ]);
        $productsArray = json_decode($request->products, true);
    

        DB::transaction(function () use ($productsArray) {
            $vente = Vente::create([
                'user_id' => auth()->id(),
                'montant_total' => 0,
                'statut' => 'completee'
            ]);

            $montantTotal = 0;

            foreach ($productsArray as $item) {
                $product = Product::findOrFail($item['id']);
                
                if ($product->stock_actuel < $item['quantite']) {
                    throw new \Exception("Stock insuffisant pour {$product->name}");
                }

                $sousTotal = $product->prix_unitaire * $item['quantite'];
                $montantTotal += $sousTotal;

                $vente->details()->create([
                    'product_id' => $product->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $product->prix_unitaire,
                    'sous_total' => $sousTotal
                ]);

                // Mise à jour du stock
                $stockAvant = $product->stock_actuel;
                $product->decrement('stock_actuel', $item['quantite']);

                MouvementStock::create([
                    'product_id' => $product->id,
                    'type' => 'sortie',
                    'quantite' => $item['quantite'],
                    'stock_avant' => $stockAvant,
                    'stock_apres' => $product->stock_actuel,
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
        $vente->load('details.product');
        return view('ventes.show', compact('vente'));
    }
}


