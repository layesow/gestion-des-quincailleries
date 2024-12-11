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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            // client_nom, client_telephone
            $table->string('client_nom')->nullable(); // Nom du client
            $table->string('client_telephone')->nullable(); // Téléphone du client
            $table->foreignId('quincaillerie_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Utilisateur effectuant la vente
            $table->foreignId('caisse_id')->constrained()->onDelete('cascade'); // Référence à la caisse utilisée
            $table->date('date_vente');
            $table->decimal('total', 10, 2); // Montant total de la vente
            $table->foreignId('modes_paiement_id')->constrained('modes_paiement')->onDelete('cascade'); // Référence au mode de paiement
            $table->enum('type_vente', ['direct', 'commande'])->default('direct'); // Type de vente (POS direct ou via commande)
            $table->decimal('remise', 10, 2)->default(0); // Remise appliquée sur le total
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
