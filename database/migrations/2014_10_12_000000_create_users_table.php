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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('adresse');
            $table->enum('statut', ['actif', 'inactif'])->default('actif'); // Défini le statut par défaut à 'actif'
            $table->foreignId('quincaillerie_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->foreignId('caisse_id')->nullable()->constrained()->onDelete('set null'); // Relie à la table 'caisses'


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
