<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sektors = [
            ['nama' => 'Kewangan'],
            ['nama' => 'Kesihatan'],
            ['nama' => 'Pendidikan'],
            ['nama' => 'Telekomunikasi'],
            ['nama' => 'Energi'],
            ['nama' => 'Pertanian'],
            ['nama' => 'Pengangkutan'],
            ['nama' => 'Pembinaan'],
        ];

        foreach ($sektors as $sektor) {
            Sektor::create($sektor);
        }
    }
}
