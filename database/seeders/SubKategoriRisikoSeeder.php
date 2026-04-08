<?php

namespace Database\Seeders;

use App\Models\SubKategoriRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKategoriRisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subKategoris = [
            ['nama' => 'Kegagalan Sistem IT', 'kategori_id' => 2],
            ['nama' => 'Kebocoran Data', 'kategori_id' => 2],
            ['nama' => 'Serangan Siber', 'kategori_id' => 6],
            ['nama' => 'Kehadiran Staf Rendah', 'kategori_id' => 2],
            ['nama' => 'Ketaksesuaian Regulasi', 'kategori_id' => 4],
            ['nama' => 'Ketidakpuasan Pelanggan', 'kategori_id' => 5],
            ['nama' => 'Kerugian Kewangan', 'kategori_id' => 3],
            ['nama' => 'Gangguan Proses Bisnis', 'kategori_id' => 2],
            ['nama' => 'Kecelakaan Kerja', 'kategori_id' => 6],
            ['nama' => 'Keadaan Persekitaran Berbahaya', 'kategori_id' => 6],
        ];

        foreach ($subKategoris as $subKategori) {
            SubKategoriRisiko::create($subKategori);
        }
    }
}
