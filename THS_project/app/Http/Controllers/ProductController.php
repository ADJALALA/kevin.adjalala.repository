<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('categorie');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code_barre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('categorie')) {
            $query->where('categorie_id', $request->categorie);
        }

        $products = $query->paginate(20);
        $categories = Categorie::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code_barre' => 'required|unique:products',
            'categorie_id' => 'required|exists:categories,id',
            'format' => 'required|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès');
    }

    public function edit(Product $product)
    {
        $categories = Categorie::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code_barre' => 'required|unique:products,code_barre,' . $product->id,
            'categorie_id' => 'required|exists:categories,id',
            'format' => 'required|string',
            'prix_unitaire' => 'required|numeric|min:0',
            'seuil_alerte' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit modifié avec succès');
    }
}
