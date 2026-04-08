<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed base tables first (no dependencies)
        $this->call(SektorSeeder::class);
        $this->call(KategoriPuncaRisikoSeeder::class);
        $this->call(KategoriRisikoSeeder::class);
        
        // Seed tables that depend on base tables
        $this->call(SubKategoriRisikoSeeder::class);
        $this->call(AgensiSeeder::class);
        $this->call(JenisAsetSeeder::class);
        
        // Seed tables that depend on the above
        $this->call(AsetSeeder::class);
        $this->call(RisikoSeeder::class);
        $this->call(PuncaRisikoSeeder::class);
        
        // Seed DaftarRisiko which depends on most other tables
        $this->call(DaftarRisikoSeeder::class);
        
        // Seed users
        $this->call(AdminUserSeeder::class);
        $this->call(DummyUsersSeeder::class);
    }
}
