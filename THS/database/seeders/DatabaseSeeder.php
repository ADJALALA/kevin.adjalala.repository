<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
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
                ['nom' => 'Beninoise', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 1250],
                ['nom' => 'Beninoise', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'Racine', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 1250],
                ['nom' => 'TEQUILA', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'PANACHE', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 1250],
                ['nom' => 'PANACHE', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'BEAUFORT', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 1250],
                ['nom' => 'DOPPEL MUNICH', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 890],
                ['nom' => 'DOPPEL MUNICH', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'DOPPEL MUNICH LAGER', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'CASTEL', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 890],
                ['nom' => 'CASTEL', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'PILS', 'format' => 'Bouteille 65cl', 'prix' => 650, 'stock' => 1250],
                ['nom' => 'PILS', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'FLAG', 'format' => 'Bouteille 65cl', 'prix' => 650, 'stock' => 1250],
                ['nom' => 'FLAG', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'EKU', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 1250],
                ['nom' => 'EKU', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'CUINESS', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 1250],
                ['nom' => 'GUINESS', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'PILS Togo', 'format' => 'Bouteille 65cl', 'prix' => 650, 'stock' => 1250],
                ['nom' => 'PILS Togo', 'format' => 'Bouteille 33cl', 'prix' => 350, 'stock' => 1250],
                ['nom' => 'RACINE Togo', 'format' => 'Bouteille 50cl', 'prix' => 500, 'stock' => 1250],
                ['nom' => 'AWOYO', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 890],
                ['nom' => 'HAGBE', 'format' => 'Bouteille 65cl', 'prix' => 600, 'stock' => 890],
            ],
            'Boissons gazeuzes' => [
                ['nom' => 'MOKA', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 680],
                ['nom' => 'MOKA', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'WORLD-COLA', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 680],
                ['nom' => 'WORLD-COLA', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'YOUZOU', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 680],
                ['nom' => 'YOUZOU', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'YOUKI-COKTAIL', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 680],
                ['nom' => 'YOUKI-COKTAIL', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'YOUKI-PAMPLEMOUSSE', 'format' => 'Bouteille 60cl', 'prix' => 600, 'stock' => 680],
                ['nom' => 'YOUKI-PAMPLEMOUSSE', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'YOUKI-TONIC', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'MALTA-TONIC', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],
                ['nom' => 'XXL', 'format' => 'Bouteille 30cl', 'prix' => 350, 'stock' => 890],

                
            ],
            // 'Eau' => [
            //     ['nom' => 'Eau Possotomé', 'format' => 'Bouteille 1.5L', 'prix' => 300, 'stock' => 850],
            //     ['nom' => 'Eau Possotomé', 'format' => 'Sachet 50cl', 'prix' => 100, 'stock' => 3000],
            // ]
        ];

        foreach ($categories as $catNom => $produits) {
            $categorie = Categorie::create(['nom' => $catNom]);
            
            foreach ($produits as $index => $prod) {
                $prefix = strtoupper(substr($catNom, 0, 3));
                $code = 'SOB' . $prefix . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
                Produit::create([
                    'nom' => $prod['nom'],
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
