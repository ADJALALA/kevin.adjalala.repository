<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'code_barre', 'categorie_id', 'format', 
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
}
