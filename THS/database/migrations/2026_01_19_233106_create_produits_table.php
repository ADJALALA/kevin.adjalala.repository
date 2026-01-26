<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code_barre')->unique();
            $table->foreignId('categorie_id')->constrained('categories');
            $table->string('format'); // Bouteille 65cl, Canette 33cl, etc.
            $table->decimal('prix_unitaire', 10, 2);
            $table->integer('stock_actuel')->default(0);
            $table->integer('seuil_alerte')->default(50);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
