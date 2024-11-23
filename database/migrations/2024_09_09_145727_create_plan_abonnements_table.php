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
        Schema::create('plan_abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom du plan
            $table->text('description')->nullable(); // Description du plan
            $table->integer('duree_jours'); // Durée en jours : 30 (1 mois), 180 (6 mois), 365 (1 an)
            $table->decimal('prix', 10, 2); // Prix de l'abonnement
            $table->enum('statut', ['actif', 'inactif'])->default('actif'); // Statut du plan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_abonnements');
    }
};
