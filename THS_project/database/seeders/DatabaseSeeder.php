<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin SOBEBRA',
            'email' => 'admin@sobebra.com',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'Magasinier Principal',
            'email' => 'magasinier@sobebra.com',
            'password' => bcrypt('password'),
            // 'role' => 'magasinier',
        ]);

        $categories = [
            'Biere' => [
                ['name' => 'Flag Spéciale', 'format' => 'Bouteille 65cl', 'prix' => 650, 'stock' => 1250],
                ['name' => 'Castel Beer', 'format' => 'Bouteille 65cl', 'prix' => 600, 'stock' => 890],
                ['name' => 'Beaufort', 'format' => 'Canette 33cl', 'prix' => 400, 'stock' => 450],
                ['name' => 'Flag Export', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 2100],
            ],
            'Soda' => [
                ['name' => 'Coca-Cola', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 680],
                ['name' => 'Fanta Orange', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 520],
                ['name' => 'Sprite', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 400],
            ],
            // 'Eau' => [
            //     ['nom' => 'Eau Possotomé', 'format' => 'Bouteille 1.5L', 'prix' => 300, 'stock' => 850],
            //     ['nom' => 'Eau Possotomé', 'format' => 'Sachet 50cl', 'prix' => 100, 'stock' => 3000],
            // ]
        ];

        foreach ($categories as $catNom => $products) {
            $categorie = Categorie::create(['name' => $catNom]);
            
            $counter = 1;
            foreach ($products as $index => $prod) {
                 $prefix = strtoupper(substr($catNom, 0, 3));
                 $code = 'SOB' . $prefix . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
                Product::create([
                    'name' => $prod['name'],
                    'code_barre' => $code,
                    'categorie_id' => $categorie->id,
                    'format' => $prod['format'],
                    'prix_unitaire' => $prod['prix'],
                    'stock_actuel' => $prod['stock'],
                    'seuil_alerte' => 50
                ]);
            }
        }
    }
}