<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ModePaiementAbonneSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(LaratrustSeeder::class);
        //UserSeeder
        $this->call(CaisseSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(RoleUserTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProduitsTableSeeder::class);
        $this->call(ModePaiementAbonneSeeder::class);
        $this->call(PlanAbonnementSeeder::class);
        $this->call(ModePaiementSeeder::class);




    }
}
