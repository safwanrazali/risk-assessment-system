<?php

namespace Database\Seeders;

use App\Models\PuncaRisiko;
use App\Models\KategoriPuncaRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuncaRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriPuncaRisikos = KategoriPuncaRisiko::all();

        $puncaRisikos = [
            [
                'nama' => 'Kegagalan Perkakasan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Gangguan Elektrik',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Ralat Perisian',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Teknologi Informasi')->first()->id,
            ],
            [
                'nama' => 'Kurangnya Latihan Kakitangan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Sumber Manusia')->first()->id,
            ],
            [
                'nama' => 'Ketiadaan Prosedur',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Operasi')->first()->id,
            ],
            [
                'nama' => 'Pemantauan Lemah',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Operasi')->first()->id,
            ],
            [
                'nama' => 'Amalan Ketidakselamatan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Keselamatan')->first()->id,
            ],
            [
                'nama' => 'Kurangnya Kesedaran Keselamatan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Keselamatan')->first()->id,
            ],
            [
                'nama' => 'Jangka Masa Tua Peralatan',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Operasi')->first()->id,
            ],
            [
                'nama' => 'Cuaca Ekstrem',
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->where('nama', 'Persekitaran')->first()->id,
            ],
        ];

        foreach ($puncaRisikos as $puncaRisiko) {
            PuncaRisiko::create($puncaRisiko);
        }
    }
}
