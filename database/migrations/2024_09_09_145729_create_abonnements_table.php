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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quincaillerie_id')->constrained()->onDelete('cascade'); // Référence à la quincaillerie
            $table->foreignId('plan_abonnement_id')->constrained('plan_abonnements')->onDelete('cascade'); // Référence au plan d'abonnement
            $table->date('date_debut')->nullable(); // Peut être null jusqu'à ce qu'il soit défini
            $table->date('date_fin')->nullable(); // Peut être null jusqu'à ce qu'il soit défini
            $table->enum('statut', ['en attente', 'actif', 'expiré', 'inactif'])->default('en attente'); // Statut de l'abonnement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
