<?php

namespace Database\Seeders;

use App\Models\Agensi;
use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sektors = Sektor::all();

        $agensis = [
            [
                'nama_agensi' => 'Bank Negara Malaysia',
                'no_tel_agensi' => '03-2698 8044',
                'website' => 'www.bnm.gov.my',
                'nama_pic' => 'Ahmad Bin Hassan',
                'no_tel_pic' => '03-2698 8888',
                'emel_pic' => 'ahmad.hassan@bnm.gov.my',
                'sektor_id' => $sektors->where('nama', 'Kewangan')->first()->id,
                'jenis_agensi' => 'Institusi Kewangan',
            ],
            [
                'nama_agensi' => 'Kementerian Kesihatan Malaysia',
                'no_tel_agensi' => '03-8883 4300',
                'website' => 'www.moh.gov.my',
                'nama_pic' => 'Dr. Siti Fatimah',
                'no_tel_pic' => '03-8883 4500',
                'emel_pic' => 'siti.fatimah@moh.gov.my',
                'sektor_id' => $sektors->where('nama', 'Kesihatan')->first()->id,
                'jenis_agensi' => 'Kementerian',
            ],
            [
                'nama_agensi' => 'Kementerian Pendidikan Malaysia',
                'no_tel_agensi' => '03-8883 5000',
                'website' => 'www.moe.gov.my',
                'nama_pic' => 'Encik Muhammad Aziz',
                'no_tel_pic' => '03-8883 5100',
                'emel_pic' => 'm.aziz@moe.gov.my',
                'sektor_id' => $sektors->where('nama', 'Pendidikan')->first()->id,
                'jenis_agensi' => 'Kementerian',
            ],
            [
                'nama_agensi' => 'Tenaga Nasional Berhad',
                'no_tel_agensi' => '03-2283 4000',
                'website' => 'www.tnb.com.my',
                'nama_pic' => 'Cik Nurul Ain',
                'no_tel_pic' => '03-2283 4500',
                'emel_pic' => 'nurul.ain@tnb.com.my',
                'sektor_id' => $sektors->where('nama', 'Energi')->first()->id,
                'jenis_agensi' => 'Syarikat Swasta',
            ],
            [
                'nama_agensi' => 'Maxis Communications',
                'no_tel_agensi' => '03-2142 0888',
                'website' => 'www.maxis.com.my',
                'nama_pic' => 'Encik Kamal Hamid',
                'no_tel_pic' => '03-2142 4500',
                'emel_pic' => 'kamal.hamid@maxis.com.my',
                'sektor_id' => $sektors->where('nama', 'Telekomunikasi')->first()->id,
                'jenis_agensi' => 'Syarikat Telekomunikasi',
            ],
        ];

        foreach ($agensis as $agensi) {
            Agensi::create($agensi);
        }
    }
}
