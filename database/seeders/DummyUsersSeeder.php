<?php

namespace Database\Seeders;

use App\Models\Agensi;
use App\Models\Sektor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $sektor = Sektor::firstOrCreate(['nama' => 'Teknologi']);

        $agensi = Agensi::firstOrCreate([
            'nama_agensi' => 'Quantum Agency',
            'sektor_id' => $sektor->id,
        ], [
            'no_tel_agensi' => '012-3456789',
            'website' => 'https://example.org',
            'nama_pic' => 'John Doe',
            'no_tel_pic' => '012-9876543',
            'emel_pic' => 'pic@example.org',
            'jenis_agensi' => 'Kerajaan',
        ]);

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'peranan' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'agency@example.com'],
            ['name' => 'Agency User', 'password' => Hash::make('password'), 'peranan' => 'agensi', 'agensi_id' => $agensi->id]
        );
    }
}
