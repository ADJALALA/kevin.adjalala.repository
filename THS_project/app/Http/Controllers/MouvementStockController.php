<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{
    protected $table = 'mouvements_stock';
    protected $fillable = ['product_id', 'type', 'quantite', 'stock_avant', 'stock_apres', 'motif', 'user_id'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}