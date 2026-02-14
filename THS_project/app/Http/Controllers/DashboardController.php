<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\vente;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'stock_total' => Product::sum('stock_actuel'),
            'alertes' => Product::enAlerte()->count(),
            'ventes_jour' => vente::whereDate('created_at', today())->count(),
            'ca_jour' => vente::whereDate('created_at', today())->sum('montant_total'),
        ];

        $productsAlerte = Product::enAlerte()->with('categorie')->get();
        
        $topVentes = DB::table('vente_detailes')
            ->join('products', 'vente_detailes.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(vente_detailes.quantite) as total_vendu'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_vendu')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'productsAlerte', 'topVentes'));
    }
}
