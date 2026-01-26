<?php

namespace App\Models;

// use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 'code_barre', 'categorie_id', 'format', 
        'prix_unitaire', 'stock_actuel', 'seuil_alerte', 'image'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class);
    }

    public function isAlerte()
    {
        return $this->stock_actuel <= $this->seuil_alerte;
    }

    public function scopeEnAlerte($query)
    {
        return $query->whereRaw('stock_actuel <= seuil_alerte');
    }
    public function venteDetails()
    {
    return $this->hasMany(VenteDetail::class, 'produit_id');
    }

    // Vérifier si le produit peut être supprimé
    public function canBeDeleted()
    {
        return $this->venteDetails()->count() === 0;
    }
}