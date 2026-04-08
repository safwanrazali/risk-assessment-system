<?php

namespace Database\Seeders;

use App\Models\DaftarRisiko;
use App\Models\Agensi;
use App\Models\Aset;
use App\Models\KategoriRisiko;
use App\Models\SubKategoriRisiko;
use App\Models\Risiko;
use App\Models\KategoriPuncaRisiko;
use App\Models\PuncaRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaftarRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agensis = Agensi::all();
        $asets = Aset::all();
        $kategoris = KategoriRisiko::all();
        $subKategoris = SubKategoriRisiko::all();
        $risikoList = Risiko::all();
        $kategoriPuncaRisikos = KategoriPuncaRisiko::all();
        $puncaRisikos = PuncaRisiko::all();

        // Ensure we have data
        if ($agensis->isEmpty() || $asets->isEmpty() || $risikoList->isEmpty()) {
            return;
        }

        $riskLevels = ['Sangat Tinggi', 'Tinggi', 'Sederhana', 'Rendah', 'Sangat Rendah'];
        $owners = ['Ketua IT', 'Ketua Keselamatan', 'Pentadbir', 'Ketua Pematuhan', 'Ketua Operasi'];
        
        // Generate 100+ dummy risk data
        for ($i = 1; $i <= 120; $i++) {
            $impak = rand(1, 5);
            $kebarangkalian = rand(1, 5);
            $skorRisiko = $impak * $kebarangkalian;
            
            // Determine risk level based on score
            $tahapRisiko = match (true) {
                $skorRisiko >= 20 => 'Sangat Tinggi',
                $skorRisiko >= 12 => 'Tinggi',
                $skorRisiko >= 8 => 'Sederhana',
                $skorRisiko >= 4 => 'Rendah',
                default => 'Sangat Rendah'
            };
            
            DaftarRisiko::create([
                'agensi_id' => $agensis->random()->id,
                'aset_id' => $asets->random()->id,
                'kategori_id' => $kategoris->count() > 0 ? $kategoris->random()->id : null,
                'sub_kategori_id' => $subKategoris->count() > 0 ? $subKategoris->random()->id : null,
                'risiko_id' => $risikoList->random()->id,
                'kategori_punca_risiko_id' => $kategoriPuncaRisikos->count() > 0 ? $kategoriPuncaRisikos->random()->id : null,
                'punca_risiko_id' => $puncaRisikos->count() > 0 ? $puncaRisikos->random()->id : null,
                'impak' => $impak,
                'kebarangkalian' => $kebarangkalian,
                'skor_risiko' => $skorRisiko,
                'tahap_risiko' => $tahapRisiko,
                'kawalan_sedia_ada' => 'Kawalan Sedia Ada ' . $i . ', Pemantauan Berkala',
                'pelan_mitigasi' => 'Pelan Mitigasi ' . $i . ', Penambahbaikan Proses',
                'pemilik_risiko' => $owners[array_rand($owners)],
            ]);
        }
    }
}
