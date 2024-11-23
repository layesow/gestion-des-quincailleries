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
        Schema::create('mouvements_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade'); // Produit associé au mouvement
            $table->foreignId('quincaillerie_id')->constrained()->onDelete('cascade'); // Quincaillerie effectuant le mouvement
            $table->enum('type', ['ajout', 'retrait']); // Type de mouvement (ajout ou retrait)
            $table->integer('quantite'); // Quantité ajoutée ou retirée
            $table->string('motif')->nullable(); // Motif du mouvement (ex. approvisionnement, vente)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements_stock');
    }
};
