<?php

namespace Database\Seeders;

use App\Models\KategoriPuncaRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPuncaRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Teknologi Informasi'],
            ['nama' => 'Sumber Manusia'],
            ['nama' => 'Operasi'],
            ['nama' => 'Kepatuhan'],
            ['nama' => 'Keselamatan'],
            ['nama' => 'Persekitaran'],
            ['nama' => 'Reputasi'],
            ['nama' => 'Pasaran'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriPuncaRisiko::create($kategori);
        }
    }
}
