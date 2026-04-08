<?php

namespace Database\Seeders;

use App\Models\JenisAset;
use App\Models\KategoriPuncaRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisAsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriPuncaRisikos = KategoriPuncaRisiko::all();

        $jenisAsets = [
            [
                'nama' => 'Peralatan Komputer',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Aplikasi Perisian',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Data dan Maklumat',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Jaringan Komputer',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Bilik Pelayan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Operasi')->first()->id,
            ],
            [
                'nama' => 'Kenderaan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Operasi')->first()->id,
            ],
            [
                'nama' => 'Kantor Pejabat',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Keselamatan')->first()->id,
            ],
        ];

        foreach ($jenisAsets as $jenisAset) {
            JenisAset::create($jenisAset);
        }
    }
}
