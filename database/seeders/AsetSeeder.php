<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\Agensi;
use App\Models\JenisAset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agensis = Agensi::all();
        $jenisAsets = JenisAset::all();

        $asets = [
            [
                'agensi_id' => $agensis->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Peralatan Komputer')->first()->id,
                'nama_aset' => 'Pelayan Web Utama',
            ],
            [
                'agensi_id' => $agensis->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Aplikasi Perisian')->first()->id,
                'nama_aset' => 'Sistem Perbankan Inti',
            ],
            [
                'agensi_id' => $agensis->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Data dan Maklumat')->first()->id,
                'nama_aset' => 'Pangkalan Data Pelanggan',
            ],
            [
                'agensi_id' => $agensis->skip(1)->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Peralatan Komputer')->first()->id,
                'nama_aset' => 'Stesen Kerja Doktor',
            ],
            [
                'agensi_id' => $agensis->skip(1)->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Aplikasi Perisian')->first()->id,
                'nama_aset' => 'Sistem Maklumat Hospital',
            ],
            [
                'agensi_id' => $agensis->skip(2)->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Jaringan Komputer')->first()->id,
                'nama_aset' => 'Jaringan Kampus Pendidikan',
            ],
            [
                'agensi_id' => $agensis->skip(3)->first()->id,
                'jenis_aset_id' => $jenisAsets->where('nama', 'Peralatan Komputer')->first()->id,
                'nama_aset' => 'Sistem Pengredan Tenaga',
            ],
        ];

        foreach ($asets as $aset) {
            Aset::create($aset);
        }
    }
}
