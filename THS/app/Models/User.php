<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Vérifier si l'utilisateur est admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Vérifier si l'utilisateur est magasinier
    public function isMagasinier()
    {
        return $this->role === 'magasinier';
    }

    // Vérifier si l'utilisateur est livreur
    public function isLivreur()
    {
        return $this->role === 'livreur';
    }

    // Vérifier si l'utilisateur est vendeur
    public function isVendeur()
    {
        return $this->role === 'vendeur';
    }

    // Obtenir le badge de rôle (pour l'affichage)
    public function getRoleBadgeAttribute()
    {
        $badges = [
            'admin' => '<span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">Admin</span>',
            'magasinier' => '<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">Magasinier</span>',
            'livreur' => '<span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Livreur</span>',
            'vendeur' => '<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">Vendeur</span>',
        ];

        return $badges[$this->role] ?? $badges['vendeur'];
    }

}
