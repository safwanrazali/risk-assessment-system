<?php

namespace Database\Seeders;

use App\Models\Risiko;
use App\Models\SubKategoriRisiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RisikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subKategoris = SubKategoriRisiko::all();

        $risikoData = [
            ['nama' => 'Kegagalan Pelayan Web', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kegagalan Sistem IT')->first()->id],
            ['nama' => 'Kegagalan Pangkalan Data', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kegagalan Sistem IT')->first()->id],
            ['nama' => 'Pembocoran Data Pelanggan', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kebocoran Data')->first()->id],
            ['nama' => 'Serangan Ransomware', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Serangan Siber')->first()->id],
            ['nama' => 'Serangan DDoS', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Serangan Siber')->first()->id],
            ['nama' => 'Ketaksesuaian Peraturan Perlindungan Data', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Ketaksesuaian Regulasi')->first()->id],
            ['nama' => 'Penipuan Kakitangan', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kehadiran Staf Rendah')->first()->id],
            ['nama' => 'Kehilangan Kakitangan Utama', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kehadiran Staf Rendah')->first()->id],
            ['nama' => 'Kecelakaan Kerja Serius', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Kecelakaan Kerja')->first()->id],
            ['nama' => 'Kebakaran di Bilik Pelayan', 'sub_kategori_risiko_id' => $subKategoris->where('nama', 'Keadaan Persekitaran Berbahaya')->first()->id],
        ];

        foreach ($risikoData as $risiko) {
            Risiko::create($risiko);
        }
    }
}
