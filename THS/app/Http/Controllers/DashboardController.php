<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Vente;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_produits' => Produit::count(),
            'stock_total' => Produit::sum('stock_actuel'),
            'alertes' => Produit::enAlerte()->count(),
            'ventes_jour' => Vente::whereDate('created_at', today())->count(),
            'ca_jour' => Vente::whereDate('created_at', today())->sum('montant_total'),
        ];

        $produitsAlerte = Produit::enAlerte()->with('categorie')->get();
        
        $topVentes = DB::table('vente_details')
            ->join('produits', 'vente_details.produit_id', '=', 'produits.id')
            ->select('produits.nom', DB::raw('SUM(vente_details.quantite) as total_vendu'))
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('total_vendu')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'produitsAlerte', 'topVentes'));
    }
}
