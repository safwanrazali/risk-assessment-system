<?php

namespace Database\Seeders;

use App\Models\KategoriRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Risiko Strategik'],
            ['nama' => 'Risiko Operasi'],
            ['nama' => 'Risiko Kewangan'],
            ['nama' => 'Risiko Kepatuhan'],
            ['nama' => 'Risiko Reputasi'],
            ['nama' => 'Risiko Keselamatan'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriRisiko::create($kategori);
        }
    }
}
