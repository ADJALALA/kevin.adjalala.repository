<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::with('categorie');

        if ($request->has('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('code_barre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        $produits = $query->paginate(20);
        $categories = Categorie::all();

        return view('produits.index', compact('produits', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code_barre' => 'required|unique:produits',
            'categorie_id' => 'required|exists:categories,id',
            'format' => 'required|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produits', 'public');
        }

        Produit::create($validated);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'code_barre' => 'required|unique:produits,code_barre,' . $produit->id,
            'categorie_id' => 'required|exists:categories,id',
            'format' => 'required|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'seuil_alerte' => 'required|integer|min:0',
        ]);

        $produit->update($validated);

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès');
    }
    public function destroy(Produit $produit)
{
    // Vérifier s'il y a des ventes liées
    if ($produit->venteDetails()->count() > 0) {
        return redirect()->route('produits.index')
            ->with('error', 'Impossible de supprimer ce produit car il a des ventes associées');
    }
    
    // Supprimer l'image si elle existe
    if ($produit->image) {
        Storage::disk('public')->delete($produit->image);
    }
    
    $produit->delete();
    
    return redirect()->route('produits.index')
        ->with('success', 'Produit supprimé avec succès');
}
}