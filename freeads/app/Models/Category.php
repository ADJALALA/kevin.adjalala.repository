<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    //protected $table = 'categories';

    use HasFactory;

    protected $fillable = ["name",] ;

    public function ads(): HasMany
    {
        return $this->hasMany(Ads::class);
    }
}
