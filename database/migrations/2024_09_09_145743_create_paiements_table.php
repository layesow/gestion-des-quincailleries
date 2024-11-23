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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abonnement_id')->constrained('abonnements')->onDelete('cascade');
            $table->date('date_paiement');
            $table->decimal('montant', 10, 2);
            $table->foreignId('mode_paiement_id')->constrained('modes_paiement')->onDelete('cascade');
            $table->enum('statut', ['en attente', 'effectué', 'échoué'])->default('en attente'); // Statut du paiement

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
