<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['numero_vente', 'user_id', 'montant_total', 'statut'];

    public function details()
    {
        return $this->hasMany(VenteDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($vente) {
            $vente->numero_vente = 'V' . date('Ymd') . str_pad(Vente::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}